<?php

namespace App\Http\Controllers;

use App\Contracts\Services\OrderServiceInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * orderService
     */
    private $orderService;

    /**
     * Constructor for OrderController
     *
     * @param OrderServiceInterface $orderService
     */
    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Get all orders
     *
     * @return object
     */
    public function index()
    {
        return $this->orderService->index();
    }

    /**
     * Get order by id
     *
     * @param integer $id
     * @return object
     */
    public function show(int $id)
    {
        return $this->orderService->show($id);
    }

    /**
     * Store order in database
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $this->orderService->store($request->all());
    }

    /**
     * Delete order by id from database
     *
     * @param integer $id
     * @return \\Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $deletedOrder =$this->orderService->destroy($id);

        return response()->json($deletedOrder, 200);
    }
}
