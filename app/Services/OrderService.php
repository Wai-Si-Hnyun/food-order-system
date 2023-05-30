<?php

namespace App\Services;

use App\Contracts\Dao\OrderDaoInterface;
use App\Contracts\Services\OrderServiceInterface;
use App\Contracts\Services\PaymentServiceInterface;
use App\Events\OrderCreated;
use App\Mail\OrderPlaced;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class OrderService implements OrderServiceInterface
{
    /**
     * order dao
     */
    private $orderDao;
    private $paymentService;

    /**
     * Constructor for the OrderService
     *
     * @param OrderDaoInterface $orderDao
     */
    public function __construct(OrderDaoInterface $orderDao, PaymentServiceInterface $paymentService)
    {
        $this->orderDao = $orderDao;
        $this->paymentService = $paymentService;
    }

    /**
     * Get all orders
     *
     * @return object
     */
    public function index()
    {
        return $this->orderDao->getOrders();
    }

    /**
     * Get user's orders
     *
     * @param integer $id
     * @return object
     */
    public function getOrdersByUserId(int $id)
    {
        return $this->orderDao->getOrdersByUserId($id);
    }

    /**
     * Get delivered orders
     *
     * @return object
     */
    public function getDeliveredOrders()
    {
        return $this->orderDao->getDeliveredOrders();
    }

    /**
     * Get total revenue of the website
     *
     * @return integer
     */
    public function getTotalRevenue()
    {
        return $this->orderDao->getTotalRevenue();
    }

    /**
     * Get monthly revenue
     *
     * @return array
     */
    public function getMonthlyRevenueInfo()
    {
        // Get the current date
        $now = Carbon::now();

        // Calculate the total revenue for the current and previous month
        $currentMonthRevenue = $this->orderDao->calculateMonthlyRevenue($now->month, $now->year);
        $previousMonth = $now->copy()->subMonthNoOverflow();
        $previousMonthRevenue = $this->orderDao->calculateMonthlyRevenue($previousMonth->month, $previousMonth->year);

        // Calculate the change in revenue
        $revenueChange = $this->calculateRevenueChange($currentMonthRevenue, $previousMonthRevenue);

        // Calculate the percentage change in revenue
        $percentageChange = $this->calculatePercentageChange($revenueChange, $previousMonthRevenue);

        $revenueData = $this->formatMonthlyRevenueData($currentMonthRevenue, $percentageChange);

        return $revenueData;
    }

    /**
     * Get yearly revenue
     *
     * @return array
     */
    public function getYearlyRevenueInfo()
    {
        // Get the current date
        $now = Carbon::now();

        // Calculate the total revenue for the current year
        $currentYearRevenue = $this->orderDao->calculateYearlyRevenueInfo($now->year);

        // Calculate the total revenue for the previous year
        $previousYear = $now->copy()->subYear();
        $previousYearRevenue = $this->orderDao->calculateYearlyRevenueInfo($previousYear->year);

        // Calculate the change in revenue
        $revenueChange = $this->calculateRevenueChange($currentYearRevenue, $previousYearRevenue);

        // Calculate the percentage change in revenue
        $percentageChange = $this->calculatePercentageChange($revenueChange, $previousYearRevenue);

        $revenueData = $this->formatYearlyRevenueData($currentYearRevenue, $percentageChange);

        return $revenueData;
    }

    /**
     * Get order by id
     *
     * @param integer $id
     * @return object
     */
    public function show(int $id)
    {
        return $this->orderDao->getOrderById($id);
    }

    /**
     * Store an order in the database
     *
     * @param object $data
     * @return boolean
     */
    public function store(object $data)
    {
        if ($this->paymentService->getStatus()) {
            // Generate the unique order code
            $orderCode = $this->generateUniqueOrderCode();

            // Create the billing details record
            $billingDetailsData = [
                'order_code' => $orderCode,
                'name' => $data->billingInfo['name'],
                'country' => $data->billingInfo['country'],
                'state' => $data->billingInfo['state'],
                'city' => $data->billingInfo['city'],
                'address' => $data->billingInfo['address'],
                'phone' => $data->billingInfo['phone'],
                'note' => $data->billingInfo['note'],
            ];

            // Create the payment details record
            $payment_data = Session::get('payment_data');
            $payment_data['order_code'] = $orderCode;

            // Calculate the total price of all products in the order
            $totalPrice = 0;
            foreach ($data->items as $item) {
                $totalPrice += $item['price'] * $item['quantity'];
            }

            // Create the order record
            $orderData = [
                'user_id' => $data['user_id'],
                'order_code' => $orderCode,
                'total_price' => $totalPrice,
            ];

            // Store order in order database
            $order = $this->orderDao->storeOrder($orderData);

            // Store billing details in billing details database
            $this->orderDao->storeBillingDetails($billingDetailsData);

            // Store payment details in payment database
            $this->paymentService->store($payment_data);

            // Create the order list records
            foreach ($data->items as $item) {
                $orderListsData = [
                    'user_id' => $data['user_id'],
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'total' => $item['price'] * $item['quantity'],
                    'order_code' => $orderCode,
                ];
                // Store order lists in order list database
                $this->orderDao->storeOrderList($orderListsData);
            }

            // Load the users relationship
            $order->load('user', 'orderlists.product', 'billingdetail');

            Session::forget(['payment-complete', 'payment_data', 'cart']);

            event(new OrderCreated($order));

            return true;
        } else {
            return false;
        }
    }

    /**
     * Change order status
     *
     * @param integer $status
     * @param integer $id
     * @return void
     */
    public function changeOrderStatus(int $status, int $id)
    {
        if ($status == 1) {
            $order = $this->orderDao->getOrderById($id);

            // Queue the confirmation email
            Mail::to($order->user->email)->queue(new OrderPlaced($order));
        }
        $this->orderDao->changeOrderStatus($status, $id);
    }

    /**
     * Change deliver status
     *
     * @param integer $status
     * @param integer $id
     * @return void
     */
    public function changeDeliverStatus(int $status, int $id)
    {
        $this->orderDao->changeDeliverStatus($status, $id);
    }

    /**
     * Delete order by id
     *
     * @param integer $id
     * @return object
     */
    public function destroy(int $id)
    {
        return $this->orderDao->deleteOrder($id);
    }

    /**
     * Generate a unique order code
     *
     * @return string
     */
    public function generateUniqueOrderCode()
    {
        $orderCode = $this->generateOrderCode();

        while ($this->orderDao->checkOrderCode($orderCode)) {
            // If the order code exists, generate a new one
            $orderCode = $this->generateOrderCode();
        }

        return $orderCode;
    }

    /**
     * Generate a random order code
     *
     * @return string
     */
    public function generateOrderCode()
    {
        return Str::random(8);
    }

    private function calculateRevenueChange($current, $previous)
    {
        return $current - $previous;
    }

    private function calculatePercentageChange($change, $previous)
    {
        return ($previous != 0) ? ($change / $previous) * 100 : 0;
    }

    private function formatMonthlyRevenueData($current, $percentageChange)
    {
        return [
            'currentMonthRevenue' => $current,
            'percentageChange' => $percentageChange,
        ];
    }

    private function formatYearlyRevenueData($current, $percentageChange)
    {
        return [
            'currentYearRevenue' => $current,
            'percentageChange' => $percentageChange,
        ];
    }
}
