@extends('front.base')

@section('content')
<section class="home-hero bg-covered"></section>
<section class="flex-col flex-center-y pd-y-7">
    <h1 class="h1 text-colour uppercase">Welcome to the Uptowner</h1>
    <p class="text-large text-center text-constrain">We make delicious american diner style food. A huge emphasis on breakfast and lunch. Not to mention our mouth-watering burgers and sandwiches. Beers can be enjoyed on our patio or inside with live sport on.</p>
    <a href="#" class="h4 text-colour uppercase bd-col bd-3 rounded-2 pd-x-4 pd-y-2">Read on</a>
</section>
<section class="favorites bg-covered pd-y-7 flex-col flex-center-y">
    <h1 class="h1 uppercase text-center text-colour-light pb-7">Our Favorites</h1>
    <div class="w-con mg-x-a grid col-4">
        <div class="pd-2 rounded-1 bg-light flex-col flex-spaced mg-x-a">
            <div>
                <img src="/images/burger_square.jpeg" alt="" class="max-w-100">
                <p class="pl-2 h4">Uptowner Benny</p>
                <p class="pl-2 body-text mg-y-1">2 Poached eggs, Sausage, Tomato, Creole Hollandaise</p>
            </div>
            <p class="pl-2 h4 text-colour">NT$260</p>
        </div>
        <div class="pd-2 rounded-1 bg-light flex-col flex-spaced mg-x-a">
            <div>
                <img src="/images/f1_sq.jpg" alt="" class="max-w-100">
                <p class="pl-2 h4">Uptowner Benny</p>
                <p class="pl-2 body-text mg-y-1">2 Poached eggs, Sausage, Tomato, Creole Hollandaise, Chinese basil, salt and pepper and some cheese</p>
            </div>
            <p class="pl-2 h4 text-colour">NT$260</p>
        </div>
        <div class="pd-2 rounded-1 bg-light flex-col flex-spaced mg-x-a">
            <div>
                <img src="/images/f2_sq.jpeg" alt="" class="max-w-100">
                <p class="pl-2 h4">Uptowner Benny with Spicy Stuff</p>
                <p class="pl-2 body-text mg-y-1">2 Poached eggs, Sausage, Tomato, Creole Hollandaise</p>
            </div>
            <p class="pl-2 h4 text-colour">NT$260</p>
        </div>
        <div class="pd-2 rounded-1 bg-light flex-col flex-spaced mg-x-a">
            <div>
                <img src="/images/f3_sq.jpg" alt="" class="max-w-100">
                <p class="pl-2 h4">Uptowner Benny</p>
                <p class="pl-2 body-text mg-y-1">2 Poached eggs, Sausage, Tomato, Creole Hollandaise</p>
            </div>
            <p class="pl-2 h4 text-colour">NT$260</p>
        </div>
    </div>
    <a href="#" class="h4 text-colour-light uppercase bd-col-light mt-7 bd-3 rounded-2 pd-x-4 pd-y-2">See Menu</a>
</section>
    <section class="specials bg-pattern-grey pd-y-7">
        <h1 class="h1 uppercase text-center text-colour pb-7">Special of the Day</h1>
        <div class="flex-col flex-center-y">
            <img src="/images/special_image.jpg" class="text-constrain"  alt="">
            <p class="h2 text-colour">The Hunger Buster</p>
            <p class="body-text">This breakfast will get your knickers in a knot! 2 sausages, 2 eggs, bacon, beans, toast, coffee and a juice.</p>
            <p class="h3 text-colour">NT$260</p>
            <p>Valid until 27th August 2017</p>
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
        <div class="flex-col flex-center-y flex-space">
            <p class="body-text text-constrain-small">The Uptowner is the perfect place to relax and enjoy good food in a great atmosphere. We open at 7am for the early birds, welcome group bookings, show live sport, have a great patio area, allow pets in our outdoor seating area, serve ice cold beer on tap and have a range of cocktails.</p>
            <p class="h3 text-colour">Find us</p>
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
        <div class="w-con grid col-5 pd-y-7">
            <div>
                <img class="max-w-100" src="/images/f2_sq.jpeg" alt="">
            </div>
            <div>
                <img class="max-w-100" src="/images/f2_sq.jpeg" alt="">
            </div>
            <div>
                <img class="max-w-100" src="/images/f2_sq.jpeg" alt="">
            </div>
            <div>
                <img class="max-w-100" src="/images/f2_sq.jpeg" alt="">
            </div>
            <div>
                <img class="max-w-100" src="/images/f2_sq.jpeg" alt="">
            </div>
            <div>
                <img class="max-w-100" src="/images/f2_sq.jpeg" alt="">
            </div>
            <div>
                <img class="max-w-100" src="/images/f2_sq.jpeg" alt="">
            </div>
            <div>
                <img class="max-w-100" src="/images/f2_sq.jpeg" alt="">
            </div>
            <div>
                <img class="max-w-100" src="/images/f2_sq.jpeg" alt="">
            </div>
            <div>
                <img class="max-w-100" src="/images/f2_sq.jpeg" alt="">
            </div>
        </div>
        <a href="#" class="h4 text-colour uppercase bd-col bd-3 rounded-2 pd-x-4 pd-y-2">Follow Us</a>
    </section>
@endsection