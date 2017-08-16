@extends('front.base', ['pageName' => 'event-show'])

@section('content')
    <a href="/events" class="pd-4 dib h5 text-colour uppercase">&larr; Back to events page</a>
    @if($event->hasOwnImage())
    <div class="mt-10 mb-4 w-con-800 mg-x-a no-space">
        <img class="w-100 max-w-100" src="{{ $event->imageUrl('web') }}" alt="{{ $event->title }}">
    </div>
    @endif
    <div class="flex-col flex-center-y">
        <p class="mt-2 mb-0 h3 text-colour uppercase">{{ $event->name }}</p>
        <p class="mg-y-0 h4">{{ $event->description }}</p>
        <p class="mt-4 mb-0 fw-700 body-text">{{ $event->event_date->format('jS M, Y') }}</p>
        <p class="mt-0 mb-2 body-text">
            <small>{{ $event->time_of_day }}</small>
        </p>
        <p class="body-text w-con-800 text-center">{{ $event->long_description }}</p>
    </div>
    <h4 class="h3 mt-8 text-colour text-center uppercase">Where to find us</h4>
    <div id="map" class="mg-y-8" style="height: 300px; width: 100%;">

    </div>
    <article>
        <p class="text-center mg-y-2 body-text fw-700">Huamei Street Alley 480 No. 1</p>
        <p class="text-center mg-y-2 body-text fw-700">Taichung, Taiwan</p>
        <p class="text-center mg-y-2 body-text fw-700">40360</p>
        <p class="text-center mg-y-2 body-text fw-700">Tel: 04 2363 7899</p>
    </article>
    <div class="flex-center-y flex-col mg-y-10">
        <p class="h3 text-colour uppercase">Let your friends know</p>
        <div class="pt-7">
            <a href="#" class="social-icon mg-2">@include('svgicons.facebook')</a>
            <a href="#" class="social-icon mg-2">@include('svgicons.twitter')</a>
        </div>
    </div>
    <div class="flex-col flex-center-y mg-y-10">
        <a href="#" class="h4 text-colour uppercase bd-col bd-4 fw-700 rounded-2 pd-x-4 pd-y-2">Book a table</a>
        <a href="/events" class="mt-6 text-colour uppercase h5">Back to events</a>
    </div>

@endsection

@section('bodyscripts')
    <script>
        function initMap() {
            console.log('mapping');
            var uptowner = {lat: 24.155553, lng: 120.660587};
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 16,
                center: uptowner,
                gestureHandling: 'cooperative',
                scrollwheel: false
            });
            var marker = new google.maps.Marker({
                position: uptowner,
                map: map
            });
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7yHnO6d1o5taaCXBBtvDxZuu9n_8dyF4&callback=initMap">
    </script>
@endsection

