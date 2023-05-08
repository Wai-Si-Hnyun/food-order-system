<?php

namespace App\Contracts\Services;

interface OrderServiceInterface
{
    /**
     * Store order
     *
     * @param array $data
     * @return void
     */
    public function store(array $data);

    /**
     * Generate order code
     *
     * @return string
     */
    public function generateOrderCode();
}