<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Contracts\Dao\OrderDaoInterface;
use App\Contracts\Services\OrderServiceInterface;

class OrderService implements OrderServiceInterface
{
    /**
     * order dao
     */
    private $orderDao;

    /**
     * Constructor for the OrderService
     *
     * @param OrderDaoInterface $orderDao
     */
    public function __construct(OrderDaoInterface $orderDao)
    {
        $this->orderDao = $orderDao;
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
     * @param array $data
     * @return void
     */
    public function store(array $data)
    {
        // Generate the unique order code
        $orderCode = $this->generateUniqueOrderCode();

        // Calculate the total price of all products in the order
        $totalPrice = 0;
        foreach ($data['products'] as $product) {
            $totalPrice += $product['price'] * $product['quantity'];
        }

        // Create the order record
        $orderData = [
            'user_id' => $data['user_id'],
            'order_code' => $orderCode,
            'total_price' => $totalPrice
        ];

        // Store order in order database
        $this->orderDao->storeOrder($orderData);

        // Create the order list records
        foreach ($data['products'] as $product) {
            $orderListsData = [
                'user_id' => $data['user_id'],
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
                'total' => $product['price'] * $product['quantity'],
                'order_code' => $orderCode
            ];
            // Store order lists in order list database
            $this->orderDao->storeOrderList($orderListsData);
        }
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
    private function generateOrderCode()
    {
        return Str::random(8);
    }
}