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
     * Get order by id
     *
     * @param integer $id
     * @return object
     */
    public function show(int $id);

    /**
     * Store order
     *
     * @param array $data
     * @return void
     */
    public function store(array $data);

    /**
     * Delete order by id
     *
     * @param integer $id
     * @return object
     */
    public function destroy(int $id);

    /**
     * Generate order code
     *
     * @return string
     */
    public function generateOrderCode();
}