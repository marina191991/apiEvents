<?php

namespace App\Http\Resources;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemsResource extends JsonResource
{
    /** @var Ticket */
    public $resource;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'barcode' => $this->resource->barcode,
            'place_id' => $this->resource->place_id,
            'order_id' => $this->resource->order_id,
            'price' => $this->resource->place->price
        ];
    }
}
