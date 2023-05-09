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
     * Store order to order table
     *
     * @param array $data
     * @return void
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
}