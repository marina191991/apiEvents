<?php

namespace App\Service;

use App\Models\Place;

class PlaceService
{
    public function create(float $price, int $row, int $quota, int $block_id, int $number_in_row): Place
    {
        $place = new Place();
        $place->price = $price;
        $place->row = $row;
        $place->quota = $quota;
        $place->block_id = $block_id;
        $place->number_in_row = $number_in_row;
        $place->save();
        return $place;
    }
}
