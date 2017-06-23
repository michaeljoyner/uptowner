<?php

namespace App\Http\Controllers\Admin\Services;

use App\Occasions\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventsServiceController extends Controller
{
    public function index()
    {
        return Event::orderBy('event_date')->get();
    }
}
