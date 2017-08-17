@extends('front.base')

@section('content')
    @if($events->featured && $events->featured->hasOwnImage())
        <div class="relative banner bg-covered"
             style="background-image: url({{ url($events->featured->imageURL('web')) }})">
            <div class="absolute-bottom bg-opaque flex-col flex-center-y">
                <p class="mt-2 mb-0 h3 text-colour uppercase"><a href="/events/{{ $events->featured->slug }}">{{ $events->featured->name }}</a></p>
                <p class="mg-y-0 body-text text-largish">{{ $events->featured->description }}</p>
                <p class="mt-4 mb-0 fw-700 body-text">{{ $events->featured->event_date->format('jS M, Y') }}</p>
                <p class="mt-0 mb-2 body-text text-largish">
                    <small>{{ $events->featured->time_of_day }}</small>
                </p>
            </div>
        </div>
    @endif
    <section class="pd-y-10 pd-x-4 flex-col flex-center-y">
        <h3 class="h1 text-colour text-center uppercase mb-9">Live Sports & Events</h3>
        <p class="text-constrain body-text text-largish text-center mt-0">The Uptowner is one of the few places in Taichung
            that shows live sports from North America, including NFL, NBA and NHL. Catch the game on one of our 12
            plasma TV’s while munching on some snacks and drinking a cold beverage. We even open especially for big
            games!</p>
    </section>
    @if($events->comingSoon()->count())
    <section class="pd-y-10 bg-covered coming-soon-section">
        <h3 class="h1 text-colour-light text-center uppercase mb-10">Coming Soon</h3>
        @foreach($events->comingSoon() as $event)
            <a href="/events/{{ $event->slug }}">
            <div class="flex bg-light w-con-800 mg-y-4 mg-x-a hover-shadow">
                <div class="no-space">
                    <img width="200" src="{{ $event->imageUrl('thumb') }}" alt="{{ $event->name }}">
                </div>
                <div class="pt-2 pb-1 pd-x-4">
                    <p class="mt mb-0 h3">{{ $event->name }}</p>
                    <p class="mg-y-1 body-text no-mobile">{{ $event->description }}</p>
                    <p class="mt-5 mb-0 body-text">
                        {{ $event->time_of_day }}
                    </p>
                    <p class="mb-2 mt-0 body-text">{{ $event->event_date->format('jS M, Y') }}</p>
                </div>
            </div>
            </a>
        @endforeach
    </section>
    @endif
    <section class="pd-y-10">
        <h3 class="h1 mb-10 text-center uppercase">Upcoming Events</h3>
        @foreach($events->restOfEvents() as $event)
            <div class="pd-4 w-con-800 mg-x-a bg-muted mg-y-4">
                <p class="mb-0 text-colour h4"><a href="/events/{{ $event->slug }}">{{ $event->name }}</a></p>
                <p class="mb-2 mt-0 body-text text-largish">{{ $event->description }}</p>
                <p class="body-text mt-5 mb-0">{{ $event->event_date->format('jS M, Y') }}</p>
                <p class="mt-0 body-text">{{ $event->time_of_day }}</p>
            </div>
        @endforeach
    </section>
@endsection

