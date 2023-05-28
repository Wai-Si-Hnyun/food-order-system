<?php

namespace App\Dao;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderList;
use App\Models\BillingDetails;
use App\Contracts\Dao\OrderDaoInterface;

class OrderDao implements OrderDaoInterface
{
    /**
     * Get all orders
     *
     * @return object
     */
    public function getOrders()
    {
        return Order::with('user')
            ->when(request('key'), function($query) {
                $query->whereHas('user', function ($q) {
                    $q->where('name', 'LIKE', '%' . request('key') . '%');
                })
                ->orWhere('order_code', 'LIKE', '%' . request('key') . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
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
     * Get user's orders
     *
     * @param integer $userId
     * @return object
     */
    public function getOrdersByUserId(int $userId)
    {
        return Order::where('user_id', $userId)
            ->with('orderlists.product')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    /**
     * Get delivered orders
     *
     * @return object
     */
    public function getDeliveredOrders()
    {
        return Order::where('delivered', 1)->get();
    }

    /**
     * Get total revenue of the website
     *
     * @return integer
     */
    public function getTotalRevenue()
    {
        return Order::where('status', 1)->sum('total_price');
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

        // Calculate the total revenue for the current month
        $currentMonthRevenue = Order::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->where('status', 1)
            ->sum('total_price');

        // Calculate the total revenue for the previous month
        $previousMonth = $now->copy()->subMonth();
        $previousMonthRevenue = Order::whereMonth('created_at', $previousMonth->month)
            ->whereYear('created_at', $previousMonth->year)
            ->where('status', 1)
            ->sum('total_price');

        // Calculate the change in revenue
        $revenueChange = $currentMonthRevenue - $previousMonthRevenue;

        // Calculate the percentage change in revenue
        $percentageChange = ($previousMonthRevenue != 0) ? ($revenueChange / $previousMonthRevenue) * 100 : 0;

        $revenueData = [
            'currentMonthRevenue' => $currentMonthRevenue,
            'percentageChange' => $percentageChange,
        ];

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
        $currentYearRevenue = Order::whereYear('created_at', $now->year)
            ->where('status', 1)
            ->sum('total_price');

        // Calculate the total revenue for the previous year
        $previousYear = $now->copy()->subYear();
        $previousYearRevenue = Order::whereYear('created_at', $previousYear->year)
            ->where('status', 1)
            ->sum('total_price');

        // Calculate the change in revenue
        $revenueChange = $currentYearRevenue - $previousYearRevenue;

        // Calculate the percentage change in revenue
        $percentageChange = ($previousYearRevenue != 0) ? ($revenueChange / $previousYearRevenue) * 100 : 0;

        $revenueData = [
            'currentYearRevenue' => $currentYearRevenue,
            'percentageChange' => $percentageChange,
        ];

        return $revenueData;
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