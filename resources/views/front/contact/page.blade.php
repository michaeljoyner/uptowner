@extends('front.base', ['pageName' => 'contact-page'])

@section('content')
    <h1 class="h1 text-colour mt-10 uppercase text-center">Contact Us</h1>
    <p class="body-text mg-y-7 text-center w-con-600 mg-x-a">Stay tuned for our new booking form, coming soon! In the meantime, if you'd like to book a table please send a message and let us know for how many people, and when.</p>
    <contact-form url="/contact" button-text="send"></contact-form>
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