<?php

namespace App\Http\Controllers\Admin;

use App\Occasions\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventsController extends Controller
{

    public function index()
    {
        return view('admin.events.index');
    }

    public function store()
    {
        $this->validate(request(), [
            'event_date' => 'required|date|after_or_equal:today',
            'name' => 'required_without:zh_name',
            'zh_name' => 'required_without:name'
        ]);
        $event = Event::createWithTranslations(request()->all());

        return $event;
    }

    public function update(Event $event)
    {
        $this->validate(request(), [
            'event_date' => 'required|date|after_or_equal:today',
            'name' => 'required_without:zh_name',
            'zh_name' => 'required_without:name'
        ]);

        $event->updateWithTranslations(request()->all());
        $event = $event->fresh();

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
    }

    public function delete(Event $event)
    {
        $event->delete();

        return 'ok';
    }
}
