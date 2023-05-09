<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Models\Order;
use App\Service\OrderService;
use Illuminate\Http\JsonResponse;


class OrderController extends Controller
{
    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * @param Order $order
     * @return JsonResponse
     */
    public function confirm(Order $order): JsonResponse
    {
        $order = $this->orderService->confirm($order);
        return new JsonResponse($order);
    }

    /**
     * @param Order $order
     * @return JsonResponse
     */
    public function cancel(Order $order): JsonResponse
    {
        $order = $this->orderService->cancel($order);
        return new JsonResponse($order);
    }

    /**
     * @param Order $order
     * @return JsonResponse
     */
    public function get(Order $order): JsonResponse
    {
        $order = $this->orderService->get($order);

        return new JsonResponse($order);
    }

    /**
     * @param CreateOrderRequest $request
     * @return JsonResponse
     */

    public function create(CreateOrderRequest $request): JsonResponse
    {
        $placesIds=collect($request->input('places'));
        $createOrder = $this->orderService->create($placesIds);

                 return new JsonResponse($createOrder);
    }
}
