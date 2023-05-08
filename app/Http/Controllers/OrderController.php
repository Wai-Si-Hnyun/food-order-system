<?php

namespace App\Http\Controllers;

use App\Contracts\Services\OrderServiceInterface;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $orderService;

    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    public function store(OrderRequest $request)
    {
        $this->orderService->store($request->all());
    }
}
