@extends('front.base', [$pageName = 'home-page'])

@section('content')
<section class="home-hero bg-covered relative of-hidden banner">
    <a href="#" class="hero-cta hidden h4 text-colour uppercase bd-col bd-3 rounded-2 pd-x-4 pd-y-2">Book Now</a>
</section>
<section class="flex-col flex-center-y pd-y-7">
    <h1 class="h1 text-colour uppercase">Welcome to the Uptowner</h1>
    <p class="text-large text-center text-constrain">We make delicious american diner style food. A huge emphasis on breakfast and lunch. Not to mention our mouth-watering burgers and sandwiches. Beers can be enjoyed on our patio or inside with live sport on.</p>
    <a href="#" class="h4 text-colour uppercase bd-col bd-3 rounded-2 pd-x-4 pd-y-2">Read on</a>
</section>
<section class="favorites bg-covered pd-y-7 flex-col flex-center-y">
    <h1 class="h1 uppercase text-center text-colour-light pb-7">Our Favorites</h1>
    <div class="w-con mg-x-a grid col-4">
        @foreach($favourites as $item)
            <div class="pd-2 rounded-1 bg-light flex-col flex-spaced mg-x-a">
                <div>
                    <img src="{{ $item->imageUrl('thumb') }}" alt="{{ $item->name }}" class="max-w-100">
                    <p class="pl-2 h4">{{ $item->name }}</p>
                    <p class="pl-2 pb-4 body-text mg-y-1">{{ $item->description }}</p>
                </div>
                <p class="pl-2 h4 text-colour">NT${{ $item->price }}</p>
            </div>
        @endforeach
    </div>
    <a href="#" class="h4 text-colour-light uppercase bd-col-light mt-7 bd-3 rounded-2 pd-x-4 pd-y-2">See Menu</a>
</section>
    <section class="specials bg-pattern-grey pd-y-7">
        <h1 class="h1 uppercase text-center text-colour pb-7">Special of the Day</h1>
        <div data-flickity='{"imagesLoaded": true}' class="w-con-800 mg-x-a">
            @foreach($specials as $special)
            <div class="flex-col flex-center-y">
                <img src="{{ $special->imageUrl('web') }}" class="text-constrain"  alt="{{ $special->name }}">
                <p class="h2 text-colour">{{ $special->name }}</p>
                <p class="body-text">{{ $special->description }}</p>
                <p class="h3 text-colour">NT${{ $special->price }}</p>
                <p>{{ $special->timeWindow() }}</p>
            </div>
            @endforeach
        </div>
    </section>
    <section class="bg-col pd-y-9">
        <div class="text-constrain mg-x-a">
            <p class="text-center text-colour-light h2">"The best authentic food in Taichung"</p>
            <p class="text-right text-colour-light">&dash; Brandon Pigaeu</p>
        </div>
    </section>
    <section class="flex flex-split">
        <div class="no-space bg-col">
            <img class="max-w-100" src="/images/cafe_outdoors.jpg" alt="outdoor cafe">
        </div>
        <div class="flex-col flex-center-y flex-spaced">
            <p class="body-text text-largish text-constrain-small pt-7">The Uptowner is the perfect place to relax and enjoy good food in a great atmosphere. We open at 7am for the early birds, welcome group bookings, show live sport, have a great patio area, allow pets in our outdoor seating area, serve ice cold beer on tap and have a range of cocktails.</p>
            <div class="flex-col flex-center-y pb-7">
                <p class="h3 text-colour">Find us</p>
                <p class="text-small mt-0 mb-4 text-grey body-text">(On Google Maps)</p>
                <a href="#">
                    @include('svgicons.location', ['classes' => 'icon-large icon-colour'])
                </a>
            </div>
        </div>
    </section>
    <section class="flex flex-space bg-col pd-y-7 text-colour-light text-center">
        <div class="pd-x-6 body-text">
            <p class="h1">Bookings</p>
            <p class="mg-y-2">04 2326 0429</p>
            <p class="mg-y-2">or</p>
            <p class="mg-y-2">Book Online</p>
        </div>
        <div class="pd-x-6 body-text">
            <p class="h1">Location</p>
            <p>Huamei Street Alley 480 #1, 40360 Taichung, Taiwan</p>
        </div>
        <div class="pd-x-6 body-text">
            <p class="h1">Hours</p>
            <p>Mon- Fri: 7am - 10pm</p>
            <p>Sat - Sun: 7am - 11pm</p>
        </div>
    </section>
    <section class="pd-y-7 flex-col flex-center-y">
        <h1 class="h1 text-center uppercase text-colour">We're on Instagram</h1>
        <instagram-feed></instagram-feed>
        <a href="#" class="h4 text-colour uppercase bd-col bd-3 rounded-2 pd-x-4 pd-y-2">Follow Us</a>
    </section>
@endsection