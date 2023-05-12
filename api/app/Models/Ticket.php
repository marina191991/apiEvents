<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property $id,
 * @property $barcode
 * @property $place_id
 * @property $order_id
 */
class Ticket extends Model
{
    protected $fillable = [
        'barcode',
        'place_id',
        'order_id',
    ];

    public $timestamps = false;

    /**
     * @return BelongsTo
     */
    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    /**
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
