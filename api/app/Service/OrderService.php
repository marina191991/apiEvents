<?php

namespace App\Service;

use App\Models\Order;
use App\Models\Place;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


class OrderService
{
    /**
     * @param Collection $placesId
     * @return Order
     */
    public function create(\Illuminate\Support\Collection $placesId): Order
    {

        //проверили на квоту и взяли прайс
        $placesIdCount = $placesId->countBy();//[3=>2,1=>1]

        foreach ($placesIdCount as $key => $placeId) {
            $place = Place::query()->find($key);
            $placeQuota = $place->quota;
            if ($placeId > $placeQuota) {
                abort(404, "Количество мест id=$key осталось $placeQuota. Вы хотите приобрести $placeId");
            }
            $totalPrice[] = ($place->price) * $placeId;
        }

        $total = array_sum($totalPrice);
        $places = $placesIdCount->keys();
        //вычесть квоту
        foreach ($placesIdCount as $key => $placeId) {
            $place = Place::query()->find($key);
            $placeQuota = ($place->quota) - $placeId;
            $place->quota = $placeQuota;
            $place->save();
        }
        //создать заказ
        $order = new Order();
        $order->total = $total;
        $order->status = 'reserved';
        $order->save();

        //создать билеты
        $places->map(function ($place) use ($order): void {
            $ticket = new Ticket();
            $ticket->barcode = str(rand(100000000, 500000000));
            $ticket->place_id = $place;
            $ticket->order_id = $order->id;
            $ticket->save();
        });

        return $order;
    }

    /**
     * @param Order $order
     * @return Model|Collection|Builder|array|null
     */
    public function cancel(Order $order): Model|Collection|Builder|array|null
    {
        Order::query()->where('id', $order->id)->update(['status' => 'canceled']);
        $order = Order::query()->find($order->id);
        $order->tickets;
        return $order;
    }

    /**
     * @param Order $order
     * @return Model|Collection|Builder|array|null
     */
    public
    function get(Order $order): Model|Collection|Builder|array|null
    {
        $order = Order::query()->find($order->id);
        $order->tickets;
        return $order;
    }

    /**
     * @param Order $order
     * @return Builder|array|Collection|Model
     */
    public
    function confirm(Order $order): Builder|array|Collection|Model
    {
        Order::query()->where('id', $order->id)->update(['status' => 'confirmed']);
        $order = Order::query()->find($order->id);
        $order->tickets;
        return $order;
    }
}
