<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property $id
 * @property $title
 * @property string $city
 * @property string $date
 * @property $available_for_sale
 */
class Event extends Model
{
    public $timestamps =false;

    /**
     * @return HasMany
     */
    public function blocks(): HasMany
    {
        return $this->hasMany(Block::class);
    }

}
