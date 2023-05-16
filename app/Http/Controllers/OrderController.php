<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Contracts\Services\OrderServiceInterface;
use App\Contracts\Services\LocationServiceInterface;

class OrderController extends Controller
{
    /**
     * orderService
     */
    private $orderService;

    protected $locationService;

    /**
     * Constructor for OrderController
     *
     * @param \App\Contracts\Services\OrderServiceInterface $orderService
     * @param \App\Contracts\Services\LocationServiceInterface $locationService
     */
    public function __construct(OrderServiceInterface $orderService, LocationServiceInterface $locationService)
    {
        $this->orderService = $orderService;
        $this->locationService = $locationService;
    }

    /**
     * Get all orders
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $orders = $this->orderService->index();

        return view('admin.pages.orders.index', compact('orders'));
    }

    /**
     * Get order by id
     *
     * @param integer $id
     * @return \\Illuminate\Contracts\View\View
     */
    public function show(int $id)
    {
        $order = $this->orderService->show($id);

        return view('admin.pages.orders.detail', compact('order'));
    }

    /**
     * Store order in database
     *
     * @param \App\Http\Requests\OrderRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(OrderRequest $request)
    {
        $this->orderService->store($request);

        return response()->json(['message' => 'Order created successfully'], 200);
    }

    /**
     * Delete order by id from database
     *
     * @param integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $deletedOrder = $this->orderService->destroy($id);

        return response()->json($deletedOrder, 200);
    }

    /**
     * Go to checkout page
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function checkout()
    {
        $countries = $this->locationService->countries();

        return view('user.pages.order.checkout', compact('countries'));
    }

    /**
     * Change order status
     *
     * @param \Illuminate\Http\Request $request
     * @param integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeOrderStatus(Request $request, int $id)
    {
        $status = $request->input('status');
        $this->orderService->changeOrderStatus($status, $id);

        return response()->json(['message' => 'Order status changed successfully!'], 200);
    }

    public function changeDeliverStatus(Request $request, int $id)
    {
        $status = $request->input('status');
        $this->orderService->changeDeliverStatus($status, $id);

        return response()->json(['message' => 'Delivered status changed successfully!'], 200);
    }
}
