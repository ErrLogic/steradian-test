<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    use ApiResponseTrait;

    public function getOrders(): JsonResponse
    {
        $orders = Order::simplePaginate(15);

        return $this->successResponse($orders, 'Orders retrieved successfully.', 200);
    }

    public function getOrderById(int $id): JsonResponse
    {
        $order = Order::find($id);

        return $this->successResponse($order, 'Order retrieved successfully.', 200);
    }

    public function createOrder(OrderRequest $request): JsonResponse
    {
        $order = $request->validated();

        $orderCheck = Order::whereBetween('pickup_date', [$request->pickup_date, $request->dropoff_date])
            ->orWhereBetween('dropoff_date', [$request->pickup_date, $request->dropoff_date])
            ->where('car_id', $request->car_id)
            ->first();

        if ($orderCheck) {
            return $this->errorResponse('Error creating order', ['error_validation' => 'Order already exist.'], 400);
        }

        $createdOrder = Order::create($order);

        return $this->successResponse($createdOrder, 'Order created successfully.', 200);
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
