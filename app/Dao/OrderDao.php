<?php

namespace App\Dao;

use App\Models\BillingDetails;
use App\Models\Order;
use App\Contracts\Dao\OrderDaoInterface;
use App\Models\OrderList;

class OrderDao implements OrderDaoInterface
{
    /**
     * Get all orders
     *
     * @return object
     */
    public function getOrders()
    {
        return Order::with('user')->paginate(10);
    }

    /**
     * Get order by id
     *
     * @param integer $id
     * @return object
     */
    public function getOrderById(int $id)
    {
        return Order::where('id', $id)->with('user', 'orderlists.product', 'billingdetail', 'payment')->first();
    }

    /**
     * Store order to order table
     *
     * @param array $data
     * @return \App\Models\Order
     */
    public function storeOrder(array $data)
    {
        return Order::create($data);
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
     * Store billing data to billing_details table
     *
     * @param array $data
     * @return void
     */
    public function storeBillingDetails(array $data)
    {
        BillingDetails::create($data);
    }

    /**
     * Delete order by id
     *
     * @param integer $id
     * @return object
     */
    public function deleteOrder(int $id)
    {
        $order = Order::find($id);
        $order->delete();

        return $order;
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

    /**
     * Change order status function
     *
     * @param integer $status
     * @param integer $id
     * @return void
     */
    public function changeOrderStatus(int $status, int $id)
    {
        Order::where('id', $id)->update(['status' => $status]);
    }

    /**
     * Change deliver status function
     *
     * @param integer $status
     * @param integer $id
     * @return void
     */
    public function changeDeliverStatus(int $status, int $id)
    {
        Order::where('id', $id)->update(['delivered' => $status]);
    }
}