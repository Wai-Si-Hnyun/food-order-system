<?php

namespace App\Contracts\Services;

interface OrderServiceInterface
{
    /**
     * Get all orders
     *
     * @return object
     */
    public function index();

    /**
     * Get user's orders
     *
     * @param integer $id
     * @return object
     */
    public function getOrdersByUserId(int $id);

    /**
     * Get delivered orders
     *
     * @return object
     */
    public function getDeliveredOrders();

    /**
     * Get total revenue of the website
     *
     * @return integer
     */
    public function getTotalRevenue();

    /**
     * Get monthly revenue
     *
     * @return array
     */
    public function getMonthlyRevenueInfo();

    /**
     * Get yearly revenue
     *
     * @return array
     */
    public function getYearlyRevenueInfo();

    /**
     * Get order by id
     *
     * @param integer $id
     * @return object
     */
    public function show(int $id);

    /**
     * Store order
     *
     * @param object $data
     * @return boolean
     */
    public function store(object $data);

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

    /**
     * Delete order by id
     *
     * @param integer $id
     * @return object
     */
    public function destroy(int $id);

    /**
     * Generate unique order code
     *
     * @return string
     */
    public function generateUniqueOrderCode();

    /**
     * Generate order code
     *
     * @return string
     */
    public function generateOrderCode();
}