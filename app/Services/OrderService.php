<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Contracts\Dao\OrderDaoInterface;
use App\Contracts\Dao\PaymentDaoInterface;
use App\Contracts\Services\OrderServiceInterface;

class OrderService implements OrderServiceInterface
{
    /**
     * order dao
     */
    private $orderDao;
    private $paymentDao;

    /**
     * Constructor for the OrderService
     *
     * @param OrderDaoInterface $orderDao
     */
    public function __construct(OrderDaoInterface $orderDao, PaymentDaoInterface $paymentDao)
    {
        $this->orderDao = $orderDao;
        $this->paymentDao = $paymentDao;
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
     * Get order by id
     *
     * @param integer $id
     * @return object
     */
    public function show(int $id)
    {
        return  $this->orderDao->getOrderById($id);
    }

    /**
     * Store an order in the database
     *
     * @param object $data
     * @return void
     */
    public function store(object $data)
    {
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
            'note' => $data->billingInfo['note']
        ];

        // Create the payment details record
        $payment_data = Session::get('payment_data');
        $payment_data['order_code'] = $orderCode;

        // Calculate the total price of all products in the order
        $totalPrice = 0;
        foreach ($data->items as $item) {
            $totalPrice += $item['product']['price'] * $item['quantity'];
        }

        // Create the order record
        $orderData = [
            'user_id' => $data['user_id'],
            'order_code' => $orderCode,
            'total_price' => $totalPrice
        ];

        // Store order in order database
        $this->orderDao->storeOrder($orderData);

        // Store billing details in billing details database
        $this->orderDao->storeBillingDetails($billingDetailsData);

        // Store payment details in payment database
        $this->paymentDao->store($payment_data);

        // Create the order list records
        foreach ($data->items as $item) {
            $orderListsData = [
                'user_id' => $data['user_id'],
                'product_id' => $item['product']['id'],
                'quantity' => $item['quantity'],
                'total' => $item['product']['price'] * $item['quantity'],
                'order_code' => $orderCode
            ];
            // Store order lists in order list database
            $this->orderDao->storeOrderList($orderListsData);
        }
        
        Session::forget(['payment-complete', 'payment_data']);
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
}