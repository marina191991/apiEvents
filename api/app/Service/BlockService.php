<?php

namespace App\Service;

use App\Models\Block;

class BlockService
{
public function create(string $title,int $event_id): Block {
    $block = new Block();
    $block->title = $title;
    $block->event_id = $event_id;
    $block->save();
    return $block;
}

}
