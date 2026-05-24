<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Partner;

class HomeController extends Controller
{
    public function index()
    {
        $events = Event::with('category')->latest()->get();
        $partners = Partner::latest()->get();
        $categories = Category::latest()->get();

        return view('welcome', compact('events', 'partners', 'categories'));
    }
}
