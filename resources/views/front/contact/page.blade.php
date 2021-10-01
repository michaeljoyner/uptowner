@extends('front.base', ['pageName' => 'contact-page'])

@section('title')
    Get in Touch - Contact The Uptowner, Taichung
@endsection

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => url('images/facebook.jpg'),
        'ogDescription' => trans('contact.meta.description'),
        'ogTitle' => trans('contact.meta.title')
    ])
@endsection

@section('content')
    <h1 class="h1 uppercase text-colour text-center pd-y-9 pd-x-4">@lang('contact.intro.heading')</h1>
    <p class="body-text mg-y-7 text-center w-con-600 mg-x-a pd-x-4">@lang('contact.intro.body')</p>
    <contact-form url="/contact" button-text="send" form-locale="{{ app()->getLocale() }}"></contact-form>
    <section class="mg-y-10">
        @include('front.partials.location_info')
    </section>

@endsection

