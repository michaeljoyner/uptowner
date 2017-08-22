@extends('front.base', ['pageName' => 'contact-page'])

@section('content')
    <div class="flex flex-center pd-y-9 bg-pattern-grey bd-col bb-2">
        <h1 class="h1 uppercase text-colour text-center">@lang('contact.intro.heading')</h1>
    </div>
    <p class="body-text mg-y-7 text-center w-con-600 mg-x-a">@lang('contact.intro.body')</p>
    <contact-form url="/contact" button-text="send" form-locale="{{ app()->getLocale() }}"></contact-form>
    <section class="mg-y-10">
        @include('front.partials.location_info')
    </section>

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