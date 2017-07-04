<?php

namespace App\Http\Controllers\Admin\Services;

use App\Occasions\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventsServiceController extends Controller
{
    public function index()
    {
        return Event::orderBy('event_date')->get()->map(function($event) {
            return [
                'id' => $event->id,
                'name' => $event->name,
                'zh_name' => $event->getTranslation('name', 'zh'),
                'description' => $event->description,
                'zh_description' => $event->getTranslation('description', 'zh'),
                'time_of_day' => $event->time_of_day,
                'zh_time_of_day' => $event->getTranslation('time_of_day', 'zh'),
                'event_date' => $event->event_date->format('Y-m-d'),
                'published' => $event->published
            ];
        });
    }
}
