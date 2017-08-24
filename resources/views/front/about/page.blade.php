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
    <div class="flex flex-center pd-y-9 bg-pattern-grey bd-col bb-2">
        <h1 class="h1 uppercase text-colour text-center">@lang('about.intro.heading')</h1>
    </div>
    <div class="w-con-800 pd-x-4 mg-y-10 mg-x-a">
        <p class="body-text text-constrain">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, ipsum, ratione! Aperiam assumenda distinctio dolorem, esse ex expedita harum laboriosam mollitia neque odit perspiciatis porro quibusdam quidem, repudiandae sed tempore.</p>
        <p class="body-text text-constrain">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, ipsum, ratione! Aperiam assumenda distinctio dolorem, esse ex expedita harum laboriosam mollitia neque odit perspiciatis porro quibusdam quidem, repudiandae sed tempore.</p>
        <p class="body-text text-constrain">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, ipsum, ratione! Aperiam assumenda distinctio dolorem, esse ex expedita harum laboriosam mollitia neque odit perspiciatis porro quibusdam quidem, repudiandae sed tempore.</p>
    </div>

@endsection

