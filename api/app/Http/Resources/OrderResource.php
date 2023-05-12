<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /** @var Order */
    public $resource;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
                "id" => $this->resource->id,
                "total" => $this->resource->total,
                "status" => $this->resource->status,
                "tickets" => OrderItemsResource::collection($this->resource->tickets)
        ];
    }
}
