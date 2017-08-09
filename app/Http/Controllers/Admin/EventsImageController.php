<?php

namespace App\Http\Controllers\Admin;

use App\Occasions\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventsImageController extends Controller
{
    public function store(Event $event)
    {
        $this->validate(request(), ['image' => 'required|image']);

        $event->setImage(request('image'));

        return $event->fresh()->imageInfoArray();
    }
}
