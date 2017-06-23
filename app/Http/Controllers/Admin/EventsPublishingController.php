<?php

namespace App\Http\Controllers\Admin;

use App\Occasions\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventsPublishingController extends Controller
{
    public function update(Event $event)
    {
        $this->validate(request(), ['published' => 'required|boolean']);

        $event->update(['published' => request('published')]);

        return response()->json(['new_status' => $event->fresh()->published]);
    }
}
