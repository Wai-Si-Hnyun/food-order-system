<?php

namespace App\Contracts\Dao;

interface OrderDaoInterface
{
    /**
     * Get all orders
     *
     * @return object
     */
    public function getOrders();

    /**
     * Get order by id
     *
     * @param integer $id
     * @return object
     */
    public function getOrderById(int $id);

    /**
     * Get user's orders
     *
     * @param integer $userId
     * @return object
     */
    public function getOrdersByUserId(int $userId);

    /**
     * Store order to order table
     *
     * @param array $data
     * @return \App\Models\Order
     */
    public function storeOrder(array $data);

    /**
     * Store order list to orderlist table
     *
     * @param array $data
     * @return void
     */
    public function storeOrderList(array $data);

    /**
     * Store billing data to billing details table
     *
     * @param array $data
     * @return void
     */
    public function storeBillingDetails(array $data);

    /**
     * Delete order by id
     *
     * @param integer $id
     * @return object
     */
    public function deleteOrder(int $id);

    /**
     * Check generated order code is unique or not
     *
     * @param string $orderCode
     * @return bool
     */
    public function checkOrderCode(string $orderCode);

    /**
     * Change order status
     *
     * @param integer $status
     * @param integer $id
     * @return void
     */
    public function changeOrderStatus(int $status, int $id);

    /**
     * Change deliver status
     *
     * @param integer $status
     * @param integer $id
     * @return void
     */
    public function changeDeliverStatus(int $status, int $id);
}
