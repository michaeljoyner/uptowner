@extends('front.base', ['pageName' => 'contact-page'])

@section('title')
    The Story of an American Diner in Taichung - All About The Uptowner, Taichung
@endsection

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => url('images/facebook.jpg'),
        'ogDescription' => trans('about.meta.description'),
        'ogTitle' => trans('about.meta.title')
    ])
@endsection

@section('content')
    <h1 class="h1 uppercase text-colour text-center pd-y-9">@lang('about.intro.heading')</h1>
    <div class="w-con-800 pd-x-4 mg-y-10 mg-x-a">
        <p class="body-text text-constrain text-largish text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, ipsum, ratione! Aperiam assumenda distinctio dolorem, esse ex expedita harum laboriosam mollitia neque odit perspiciatis porro quibusdam quidem, repudiandae sed tempore.</p>
    </div>
    <div class="flex flex-split w-con-800 mb-10 mg-x-a">
        <div>
            <img class="w-con-300 w-100 block mg-x-a" src="/images/ben.jpg" alt="Ben, co-founder of Uptowner">
        </div>
        <div>
            <img class="w-con-300 w-100 block mg-x-a" src="/images/kyle.jpg" alt="Kyle, co-founder of Uptowner">
        </div>
    </div>

@endsection

