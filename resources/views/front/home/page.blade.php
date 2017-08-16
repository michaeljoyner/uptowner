@extends('front.base', [$pageName = 'home-page'])

@section('content')
<section class="home-hero bg-covered relative of-hidden banner tall">
    <a href="#" class="hero-cta hidden bg-trans h4 fw-700 text-colour-light uppercase bd-col-light bd-4 rounded-2 pd-x-4 pd-y-2">Book Now</a>
</section>
<section class="flex-col flex-center-y pd-y-10 pd-x-2">
    <h1 class="h1 text-colour uppercase text-center">Welcome to the Uptowner</h1>
    <p class="text-largish text-center body-text text-constrain mb-9 mt-9">We make delicious american diner style food. A huge emphasis on breakfast and lunch. Not to mention our mouth-watering burgers and sandwiches. Beers can be enjoyed on our patio or inside with live sport on.</p>
    <a href="#" class="h4 text-colour uppercase bd-col bd-4 fw-700 rounded-2 pd-x-4 pd-y-2">Read on</a>
</section>
<section class="favorites bg-covered pd-y-10 flex-col flex-center-y">
    <h1 class="h1 uppercase text-center text-colour-light pb-0">Our Favorites</h1>
    <div class="favorites-grid w-con mg-x-a grid col-4 mt-9 mb-10">
        @foreach($favourites as $item)
            <div class="pd-2 rounded-1 bg-light flex-col flex-spaced mg-x-a">
                <div class="inner-favorite-container">
                    <div class="image-box">
                        <img src="{{ $item->imageUrl('thumb') }}" alt="{{ $item->name }}" class="max-w-100">
                    </div>
                    <div>
                        <p class="pl-2 h5">{{ $item->name }}</p>
                        <p class="pl-2 pb-4 body-text text-smaller mg-y-1">{{ $item->description }}</p>
                    </div>
                </div>
                <p class="pl-2 h5 text-colour favorite-price">NT${{ $item->price }}</p>
            </div>
        @endforeach
    </div>
    <a href="#" class="h4 text-colour-light uppercase bd-col-light bd-4 rounded-2 pd-x-4 pd-y-2">See Menu</a>
</section>
    <section class="specials bg-pattern-grey pd-y-9">
        <h1 class="h1 uppercase text-center text-colour pb-0">Special of the Day</h1>
        <div data-flickity='{"imagesLoaded": true, "cellAlign": "left"}' class="w-con-800 mg-x-a mt-9">
            @foreach($specials as $special)
            <div class="flex-col flex-center-y special-slide">
                <img src="{{ $special->imageUrl('web') }}" class="special-slide text-constrain"  alt="{{ $special->name }}">
                <p class="h3 mt-6 text-colour">{{ $special->title }}</p>
                <p class="body-text mt-1 pd-x-4 text-center">{{ $special->description }}</p>
                <p class="h4 text-colour">NT${{ $special->price }}</p>
                <p class="body-text"><em>{{ $special->timeWindow() }}</em></p>
            </div>
            @endforeach
        </div>
    </section>
    <section class="bg-col pb-10 pt-11 pd-x-4">
        <div class="text-constrain mg-x-a">
            <p class="text-center text-colour-light h2">"The best American authentic food in Taichung"</p>
            <p class="text-right text-colour-light mb-0 body-text"><em>&dash; Brandon Pigeau</em></p>
        </div>
    </section>
    <section class="flex flex-split location">
        <div class="no-space bg-col bg-covered location-image-box">
        </div>
        <div class="flex-col flex-center-y flex-spaced pd-y-10 bg-light bg-covered map-bg">
            <p class="h3 text-colour uppercase">Join Us</p>
            <p class="body-text text-largish text-constrain-small pd-x-4 pt-4">The Uptowner is the perfect place to relax and enjoy good food in a great atmosphere. We open at 7am for the early birds, welcome group bookings, show live sport, have a great patio area, allow pets in our outdoor seating area, serve ice cold beer on tap and have a range of cocktails.</p>
            <div class="flex-col flex-center-y pt-7">
                <a href="#">
                    @include('svgicons.location', ['classes' => 'icon-large icon-colour'])
                </a>
                <p class="text-small mt-0 mb-4 pt-4 text-grey body-text"><em>Opens Google Maps</em></p>
            </div>
        </div>
    </section>
    <section class="flex flex-space bg-col pd-y-10 text-colour-light text-center detail-panel">
        <div class="pd-x-6 body-text">
            <p class="h3">Bookings</p>
            <p class="mg-y-1">04 2326 0429 or</p>
            <p class="mg-y-1"><a href="#">Book Online</a></p>
        </div>
        <div class="pd-x-6 body-text">
            <p class="h3">Location</p>
            <p class="mg-1">Huamei Street Alley 480, No. 1<br> Taichung, Taiwan</p>
        </div>
        <div class="pd-x-6 body-text">
            <p class="h3">Hours</p>
            <p class="mg-y-1">Mon- Fri: 7am - 10pm</p>
            <p class="mg-y-1">Sat - Sun: 7am - 10pm</p>
        </div>
    </section>
    <section class="pd-y-10 flex-col flex-center-y instagram">
        <h1 class="h1 mb-10 text-center uppercase text-colour">We're on Instagram</h1>
        <instagram-feed></instagram-feed>
        <a href="#" class="h4 text-colour uppercase bd-col bd-4 rounded-2 pd-x-4 pd-y-2 mt-9">Follow Us</a>
    </section>
@endsection