<?php

namespace App\Http\Controllers;

use App\Contracts\Services\OrderServiceInterface;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * orderService
     */
    private $orderService;

    /**
     * Constructor for OrderController
     *
     * @param \App\Contracts\Services\OrderServiceInterface $orderService
     */
    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Get all orders
     *
     * @return \Illuminate\Contracts\View\View|void
     */
    public function index()
    {
        $role = Auth::user()->role;

        if ($role == 'admin') {
            $orders = $this->orderService->index();

            return view('admin.pages.orders.index', compact('orders'));
        } elseif  ($role == 'user') {
            $orders = $this->orderService->getOrdersByUserId(Auth::user()->id);

            return view('user.pages.order.list', compact('orders'));
        }
    }

    /**
     * Get order by id
     *
     * @param integer $id
     * @return \Illuminate\Contracts\View\View
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
        $status = $this->orderService->store($request);

        if ($status) {
            return response()->json(['message' => 'Order created successfully'], 200);
        } else {
            return response()->json(['message' => 'Payment Required'], 402);
        }
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
        $cart = session('cart');

        return view('user.pages.order.checkout', ['cart' => $cart]);
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

    /**
     * Change deliver status 
     *
     * @param \Illuminate\Http\Request $request
     * @param integer $id
     * @return \\Illuminate\Http\JsonResponse
     */
    public function changeDeliverStatus(Request $request, int $id)
    {
        $status = $request->input('status');
        $this->orderService->changeDeliverStatus($status, $id);

        return response()->json(['message' => 'Delivered status changed successfully!'], 200);
    }
}
