<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Services\OrderService;
use App\Services\ProductService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * @var \App\Services\OrderService
     */
    protected $orderService;
    use ApiResponse;

    /**
     * @var \App\Services\ProductService
     */
    protected $productService;

    /**
     * OrderController constructor.
     *
     * @param \App\Services\OrderService   $orderService
     * @param \App\Services\ProductService $productService
     */
    public function __construct(OrderService $orderService, ProductService $productService)
    {
        $this->orderService = $orderService;
        $this->productService = $productService;
    }

     public function index()
    {
        return $this->successResponse($this->orderService->fetchOrders());
    }
    public function show($order)
    {
        return $this->successResponse($this->orderService->fetchOrder($order));
    }
    public function store(Request $request)
    {
        $result = $this->productService->fetchProduct($request->product_id);
        return $this->successResponse($this->orderService->createOrder($request->all()));
    }
    public function update(Request $request, $order)
    {
        return $this->successResponse($this->orderService->updateOrder($order, $request->all()));
    }
    public function destroy($order)
    {
        return $this->successResponse($this->orderService->deleteOrder($order));
    }
}

