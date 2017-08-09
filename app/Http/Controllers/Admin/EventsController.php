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
        return $event->fresh()->toJsonableArray();
    }

    public function delete(Event $event)
    {
        $event->delete();

        return 'ok';
    }
}
