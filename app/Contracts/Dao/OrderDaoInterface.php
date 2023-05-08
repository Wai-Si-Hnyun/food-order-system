<?php

namespace App\Contracts\Dao;

interface OrderDaoInterface
{
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
     * Check generated order code is unique or not
     *
     * @param string $orderCode
     * @return bool
     */
    public function checkOrderCode(string $orderCode);
}