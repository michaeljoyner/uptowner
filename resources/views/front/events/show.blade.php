@extends('front.base', ['pageName' => 'event-show'])

@section('title')
    {{ $event->title }}
@endsection

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => $event->hasOwnImage() ? url($event->imageUrl()) : url('images/facebook.jpg'),
        'ogDescription' => $event->description,
        'ogTitle' => $event->title
    ])
@endsection

@section('content')
    <a href="/events" class="pd-4 dib h5 text-colour uppercase hover-blue">&larr; @lang('event_show.nav.back')</a>
    @if($event->hasOwnImage())
        <div class="mt-10 mb-4 w-con-800 mg-x-a no-space">
            <img class="w-100 max-w-100" src="{{ $event->imageUrl('web') }}" alt="{{ $event->title }}">
        </div>
    @endif
    <div class="flex-col flex-center-y">
        <p class="mt-2 mb-0 h3 text-colour uppercase">{{ $event->name }}</p>
        <p class="mg-y-0 h4 w-con-800 mg-x-a pd-x-4">{{ $event->description }}</p>
        <p class="mt-4 mb-0 fw-700 body-text">{{ $event->event_date->format('jS M, Y') }}</p>
        <p class="mt-0 mb-2 body-text">
            <small>{{ $event->time_of_day }}</small>
        </p>
        <p class="body-text w-con-800 text-center">{{ $event->long_description }}</p>
    </div>
    @include('front.partials.location_info')
    <div class="flex-center-y flex-col mg-y-10">
        <p class="h3 text-colour uppercase">@lang('event_show.social.heading')</p>
        <div class="pt-7">
            <a href="#" class="social-icon mg-2">@include('svgicons.facebook')</a>
            <a href="#" class="social-icon mg-2">@include('svgicons.twitter')</a>
        </div>
    </div>
    <div class="flex-col flex-center-y mg-y-10">
        <a href="/contact"
           class="h4 text-colour uppercase bd-col bd-4 fw-700 rounded-2 pd-x-8 pd-y-2 hover-btn-invert">@lang('event_show.cta')</a>
        <a href="/events" class="mt-6 text-colour uppercase h5 hover-blue">@lang('event_show.nav.back')</a>
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
    <script type='application/ld+json'>
        {
          "@context": "http://www.schema.org",
          "@type": "SocialEvent",
          "name": "{{ $event->title }}",
          "url": "{{ Request::url() }}",
          "description": "{{ $event->description }}",
          "startDate": "{{ $event->event_date->format('Y-m-d') . 'T07:00' }}",
          "endDate": "{{ $event->event_date->format('Y-m-d') . 'T22:00' }}",
          "location": {
            "@type": "Place",
            "name": "The Uptowner Taichung",
            "sameAs": "https://uptowner.com.tw",
            "address": {
              "@type": "PostalAddress",
              "streetAddress": "Huamei Street, Alley 480, No. 1",
              "addressLocality": "Taichung",
              "addressRegion": "Taichung",
              "postalCode": "40360",
              "addressCountry": "Taiwan",
              "image": "{{ $event->hasOwnImage() ? $event->imageUrl('web') : url('images/logos/logo_full.svg') }}"
            }
          }
        }
    </script>
@endsection

