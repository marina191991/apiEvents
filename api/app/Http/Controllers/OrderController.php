<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Models\Order;
use App\Models\Ticket;
use App\Service\OrderService;
use App\Service\TicketService;
use Illuminate\Http\JsonResponse;


class OrderController extends Controller
{
    /**
     * @param $id
     * @return JsonResponse
     */
    public function confirm($id): JsonResponse
    {
        Order::query()->where('id', $id)->update(['status' => 'confirmed']);
        $order = Order::query()->find($id);
        $order->tickets;
        return new JsonResponse($order);

    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function cancel($id): JsonResponse
    {
        Order::query()->where('id', $id)->update(['status' => 'canceled']);
        $order = Order::query()->find($id);
        $order->tickets;
        return new JsonResponse($order);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function get($id): JsonResponse
    {
        $order = Order::query()->find($id);
        $order->tickets;
        return new JsonResponse($order);
    }

    /**
     * @param CreateOrderRequest $request
     * @return JsonResponse
     */

    public function create(CreateOrderRequest $request, OrderService $order, TicketService $ticketService): JsonResponse
    {
        $tickets = $request->input("places");//[12,13]

        $total = 0;
        foreach ($tickets as $ticket) {
            $ticket = Ticket::query()->find($ticket); //12
            if (($quota = $ticket->place->quota) > 0) {
                $total = $ticket->place->price + $total;
                $ticketsIds[] = $ticket->id;
                $quota = $quota - 1;
                $ticket->place()->update(['quota' => $quota]);
            }
        }
        if ($total > 0) {
            $order = $order->create($total, 'reserved');
            foreach ($ticketsIds as $ticketId) {
                $ticketService->update($ticketId, 'order_id', $order->id);
            }
            $order->tickets;
            return new JsonResponse($order);
        }
        return new JsonResponse([]);
    }
}
