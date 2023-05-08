<?php

namespace App\Dao;

use App\Models\Order;
use App\Contracts\Dao\OrderDaoInterface;
use App\Models\OrderList;

class OrderDao implements OrderDaoInterface
{
    /**
     * Store order to order table
     *
     * @param array $data
     * @return void
     */
    public function storeOrder(array $data)
    {
        Order::create($data);
    }

    /**
     * Store order list to order_list table
     *
     * @param array $data
     * @return void
     */
    public function storeOrderList(array $data)
    {
        OrderList::create($data);
    }

    /**
     * Check generated order code is exist or not
     *
     * @param string $orderCode
     * @return boolean
     */
    public function checkOrderCode(string $orderCode)
    {
        return Order::where('order_code', $orderCode)->exists();
    }
}