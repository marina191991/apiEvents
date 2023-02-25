<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\JsonResponse;

class EventController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function show(): JsonResponse
    {
        $events = Event::all();
        return new JsonResponse(['events' => $events]);
    }
}
