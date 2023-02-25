<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\JsonResponse;

class BlockController extends Controller
{
    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {

        $blocks = Event::query()->find($id)->blocks;
        foreach ($blocks as $block) {
            $block->places;
        }
        return new JsonResponse(['blocks' => $blocks]);
    }
}
