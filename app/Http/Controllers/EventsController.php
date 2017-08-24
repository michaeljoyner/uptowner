<?php

namespace App\Http\Controllers;

use App\Occasions\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index()
    {
        return view('front.events.index', ['events' => Event::upcomingList()]);
    }

    public function show($slug)
    {
        return view('front.events.show', ['event' => Event::where('slug', $slug)->firstOrFail()]);
    }
}
