<?php

namespace App\Service;

use App\Models\Event;
use DateTimeInterface;

class EventService
{
    /**
     * @param string $title
     * @param string $city
     * @param $date
     * @param int|boolean $available_for_sale
     * @return Event
     */
    public function create(string $title, string $city, DateTimeInterface $date, bool|int $available_for_sale): Event
    {
        $event = new Event();
        $event->title = $title;
        $event->city = $city;
        $event->date = $date;
        $event->available_for_sale = $available_for_sale;
        $event->save();
        return $event;
    }
}
