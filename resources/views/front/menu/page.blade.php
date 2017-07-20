@extends('front.base')

@section('content')
    <div class="flex flex-space text-colour uppercase pd-y-4 heading bb-2 bd-col">
        <a href="#">Omelettes</a>
        <a href="#">Eggs Benedict</a>
        <a href="#">Breakfast Specials</a>
        <a href="#">Appetizers</a>
        <a href="#">Burgers</a>
        <a href="#">Sandwiches</a>
        <a href="#">Drinks</a>
        <a href="#">Cocktails</a>
        <a href="#">Desserts</a>
    </div>
    <section class="pd-y-7">
        <h1 class="h1 uppercase text-colour text-center">Burgers</h1>
        <div class="flex flex-adapt flex-start">
            @foreach($burgers as $burger)
                @if($burger->hasOwnImage())
                    <img width="290" src="{{ $burger->imageUrl('thumb') }}" alt="{{ $burger->name }}">
                @endif
            @endforeach
        </div>
        <div class="w-con mg-x-a">
            @foreach($burgers as $burger)
                <article class="pd-y-4 mg-x-4">
                    <p class="h3 mb-2">{{ $burger->name }}</p>
                    <p class="body-text mg-y-2">{{ $burger->description }}</p>
                    <p class="h3 text-colour">NT${{ $burger->price }}</p>
                </article>
            @endforeach
        </div>
    </section>
@endsection
