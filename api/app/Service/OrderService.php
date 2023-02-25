<?php

namespace App\Service;

use App\Models\Order;

class OrderService
{
    /**
     * @param string $total
     * @param string $status
     * @return Order
     */
public function create(string $total, string $status): Order {
    $order = new Order();
    $order->total = $total;
    $order->status = $status;
    $order->save();
    return $order;
}
}
