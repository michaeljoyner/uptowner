<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EventsForm;
use App\Occasions\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventsController extends Controller
{

    public function index()
    {
        return view('admin.events.index');
    }

    public function store(EventsForm $form)
    {
        $event = Event::createWithTranslations($form->sanitizedData());

        return $event->toJsonableArray();
    }

    public function update(Event $event, EventsForm $form)
    {
        $event->updateWithTranslations($form->sanitizedData());
        return $event->fresh()->toJsonableArray();
    }

    public function delete(Event $event)
    {
        $event->delete();

        return 'ok';
    }
}
