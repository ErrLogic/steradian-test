<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    use ApiResponseTrait;

    public function getOrders(): JsonResponse
    {
        $orders = Order::all();

        return $this->successResponse($orders, 'Orders retrieved successfully.', 200);
    }

    public function getOrderById(int $id): JsonResponse
    {
        $order = Order::find($id);

        return $this->successResponse($order, 'Order retrieved successfully.', 200);
    }

    public function createOrder(OrderRequest $request): JsonResponse
    {
        $order = Order::create($request->validated());

        return $this->successResponse($order, 'Order created successfully.', 200);
    }

    public function updateOrder(int $id, OrderRequest $request): JsonResponse
    {
        $data = $request->validated();
        $order = Order::find($id);
        $order->update($data);

        return $this->successResponse($order, 'Order updated successfully.', 200);
    }

    public function deleteOrder(int $id): JsonResponse
    {
        $order = Order::find($id);
        $order->delete();

        return $this->successResponse($order, 'Order deleted successfully.', 200);
    }
}
