<?php

namespace App\Service;

use App\Models\Ticket;

class TicketService
{
    /**
     * @param int $id
     * @param string $row
     * @param string|int $value
     * @return Ticket
     */
    public function update(int $id, string $row, string|int $value): Ticket
    {
        $ticket = Ticket::query()->find($id);
        $ticket->$row = $value;
        $ticket->save();

        return $ticket;
    }

    /**
     * @param string $barcode
     * @param int $place_id
     * @param int|null $order_id
     * @return Ticket
     */
    public function create(string $barcode, int $place_id, int $order_id = null): Ticket
    {
        $ticket = new Ticket();
        $ticket->barcode = $barcode;
        $ticket->place_id = $place_id;
        $ticket->order_id = $order_id;
        $ticket->save();

        return $ticket;
    }
}
