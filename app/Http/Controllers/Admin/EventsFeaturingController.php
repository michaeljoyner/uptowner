<?php

namespace App\Http\Controllers\Admin;

use App\Occasions\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventsFeaturingController extends Controller
{
    public function update(Event $event)
    {
        $this->validate(request(), ['feature' => 'required|boolean']);

        if(request('feature')) {
            Event::setFeatured($event);
        } else {
            $event->update(['featured' => false]);
        }

        return ['new_status' => $event->fresh()->featured];
    }
}
