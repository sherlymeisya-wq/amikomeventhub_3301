<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventController extends Controller
{
    public function show(Event $event)
    {
        return view('event-detail', compact('event'));
    }

    public function detail()
    {
        return view('event-detail');
    }

    public function checkout()
    {
        return view('checkout');
    }
}
