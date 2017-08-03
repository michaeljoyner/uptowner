@extends('front.base')

@section('content')
    @if($events->featured)
    <div class="relative banner bg-covered" style="background-image: url({{ url($events->featured->imageURL('web')) }})">
        <div class="absolute-bottom bg-opaque flex-col flex-center-y">
            <p class="mg-y-2 h3 text-colour">{{ $events->featured->name }}</p>
            <p class="mg-y-2 h4">{{ $events->featured->description }}</p>
            <p class="mt-2 mb-0 body-text">{{ $events->featured->event_date->format('jS M, Y') }}</p>
            <p class="mg-y-1 body-text"><small>{{ $events->featured->time_of_day }}</small></p>
        </div>
    </div>
    @endif
    <section class="pd-y-7 flex-col flex-center-y">
        <h3 class="h1 text-colour uppercase">Live Sports & Events</h3>
        <p class="text-constrain body-text text-large text-center">The Uptowner is one of the few places in Taichung that shows live sports from North America, including NFL, NBA and NHL. Catch the game on one of our 12 plasma TV’s while munching on some snacks and drinking a cold beverage. We even open especially for big games!</p>
    </section>
    <section class="pd-y-7 bg-covered coming-soon-section">
        <h3 class="h2 text-colour-light text-center uppercase mb-7">Coming Soon</h3>
        @foreach($events->comingSoon() as $event)
        <div class="flex bg-light w-con-800 mg-y-4 mg-x-a">
            <div class="no-space">
                <img width="200" src="{{ $event->imageUrl('thumb') }}" alt="{{ $event->name }}">
            </div>
            <div class="pd-y-1 pd-x-4">
                <p class="mt mb-2 h3 text-colour">{{ $event->name }}</p>
                <p class="mg-y-2 body-text text-largish">{{ $event->description }}</p>
                <p class="mg-y-2 body-text"><small>{{ $event->time_of_day }}</small></p>
                <p class="mg-y-2 body-text">{{ $event->event_date->format('jS M, Y') }}</p>
            </div>
        </div>
        @endforeach
    </section>
    <section class="pd-y-7">
        <h3 class="h2 text-center uppercase">Upcoming Events</h3>
        @foreach($events->restOfEvents() as $event)
            <div class="pd-4">
                <p class="mg-y-2 h3 text-colour">{{ $event->name }}</p>
                <p class="mg-y-2 body-text text-largis">{{ $event->description }}</p>
                <p class="mg-y-2 body-text">{{ $event->time_of_day }} {{ $event->event_date }}</p>
            </div>
        @endforeach
    </section>
@endsection

