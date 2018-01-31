@extends('front.base', [$pageName = 'home-page'])

@section('title')
    The Uptowner, Taichung's Best Diner
@endsection

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => url('images/facebook.jpg'),
        'ogDescription' => trans('homepage.meta.description'),
        'ogTitle' => trans('homepage.meta.title')
    ])
    <meta name="google-site-verification" content="jBHRbHqn_u1NZ5m-L8UiNFFgND2lYxv3oVNv34T09Rs" />
@endsection

@section('content')
    <section id="hero" class="home-hero bg-covered relative of-hidden banner tall">
        <a href="/contact"
           class="transparent rise-up hero-cta bg-trans h4 fw-700 text-colour-light uppercase bd-col-light bd-4 rounded-2 pd-x-8 pd-y-2 hover-btn-invert-two one-line">@lang('homepage.hero.cta')</a>
    </section>
    <section class="flex-col flex-center-y pd-y-10 pd-x-2">
        <h1 class="h1 text-colour uppercase text-center">@lang('homepage.welcome.heading')</h1>
        <p class="text-largish text-center body-text text-constrain mb-9 mt-9">@lang('homepage.welcome.body')</p>
        {{--<a href="/about"--}}
           {{--class="h4 text-colour uppercase bd-col bd-4 fw-700 rounded-2 pd-x-8 pd-y-2 hover-btn-invert">@lang('homepage.welcome.button')</a>--}}
    </section>
    <section class="favorites bg-covered pd-y-10 flex-col flex-center-y">
        <h1 class="h1 uppercase text-center text-colour-light pb-0">@lang('homepage.favourites.heading')</h1>
        <div class="favorites-grid w-con mg-x-a grid col-4 mt-9 mb-10">
            @foreach($favourites as $item)
                <div class="pd-2 rounded-1 bg-light flex-col flex-spaced">
                    <div class="inner-favorite-container">
                        <div class="image-box">
                            <img src="{{ $item->imageUrl('thumb') }}" alt="{{ $item->name }}" class="w-100 max-w-100">
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
        <a href="/menu"
           class="h4 text-colour-light uppercase bd-col-light bd-4 rounded-2 pd-x-8 pd-y-2 hover-btn-invert-two">@lang('homepage.favourites.button')</a>
    </section>
    <section class="specials bg-pattern-grey pd-y-9">
        <h1 class="h1 uppercase text-center text-colour pb-0">@lang('homepage.specials.heading')</h1>
        @if($specials->count() > 0)
        <div data-flickity='{"imagesLoaded": true, "cellAlign": "left"}' class="w-con-800 mg-x-a mt-9">
            @foreach($specials as $special)
                <div class="flex-col flex-center-y special-slide">
                    <img src="{{ $special->imageUrl('web') }}" class="special-slide text-constrain"
                         alt="{{ $special->name }}">
                    <p class="h3 mt-6 text-colour">{{ $special->title }}</p>
                    <p class="body-text mt-1 pd-x-4 text-center">{{ $special->description }}</p>
                    <p class="h4 text-colour">{{ $special->price ? 'NT$' . $special->price : '' }}</p>
                    <p class="body-text"><em>{{ $special->timeWindow() }}</em></p>
                </div>
            @endforeach
        </div>
        @endif
    </section>
    <section class="bg-col-soft pb-10 pt-11 pd-x-4">
        <div class="text-constrain mg-x-a">
            <p class="text-center text-colour-light h2">@lang('homepage.callout.body')</p>
            <p class="text-right text-colour-light mb-0 body-text"><em>&mdash; @lang('homepage.callout.name')</em></p>
        </div>
    </section>
    <section class="flex flex-split location">
        <div class="no-space bg-col bg-covered location-image-box">
        </div>
        <div class="flex-col flex-center-y flex-spaced pd-y-10 bg-light bg-covered map-bg">
            <p class="h3 heading text-colour uppercase">@lang('homepage.location.heading')</p>
            <p class="body-text text-largish text-constrain-small pd-x-4 pt-4">@lang('homepage.location.body')</p>
            <div class="flex-col flex-center-y pt-7">
                <a href="https://www.google.com.tw/maps/place/%E9%9B%99%E5%9F%8E%E7%BE%8E%E5%BC%8F%E9%A4%90%E5%BB%B3+(Uptowner)/@24.155377,120.6583873,17z/data=!3m1!4b1!4m5!3m4!1s0x34693d9c9eb0f023:0x3fef3d34c61f0da5!8m2!3d24.155377!4d120.660576?hl=en">
                    @include('svgicons.location', ['classes' => 'icon-large icon-colour hover-shake'])
                </a>
                <p class="text-small mt-0 mb-4 pt-4 text-grey body-text"><em>@lang('homepage.location.link_text')</em>
                </p>
            </div>
        </div>
    </section>
    <section class="flex flex-space bg-col-soft pd-y-10 text-colour-light text-center detail-panel">
        <div class="pd-x-6 body-text">
            <p class="h3">@lang('homepage.details.bookings.heading')</p>
            <p class="mg-y-1">@lang('homepage.details.bookings.line_one')</p>
            <p class="mg-y-1"><a href="#" class="hover-blue">@lang('homepage.details.bookings.line_two')</a></p>
        </div>
        <div class="pd-x-6 body-text">
            <p class="h3">@lang('homepage.details.location.heading')</p>
            <p class="mg-1">@lang('homepage.details.location.line_one')<br> @lang('homepage.details.location.line_two')
            </p>
        </div>
        <div class="pd-x-6 body-text">
            <p class="h3">@lang('homepage.details.hours.heading')</p>
            <p class="mg-y-1">@lang('homepage.details.hours.line_one')</p>
            <p class="mg-y-1">@lang('homepage.details.hours.line_two')</p>
        </div>
    </section>
    <section class="pd-y-10 flex-col flex-center-y instagram">
        <h1 class="h1 mb-10 text-center uppercase text-colour">@lang('homepage.instagram.heading')</h1>
        <instagram-feed></instagram-feed>
        <a href="https://www.instagram.com/uptownertaichung/"
           class="h4 text-colour uppercase bd-col bd-4 rounded-2 pd-x-8 pd-y-2 mt-9 hover-btn-invert">@lang('homepage.instagram.button')</a>
    </section>
@endsection

@section('bodyscripts')
<script type='application/ld+json'>
    {
      "@context": "http://www.schema.org",
      "@type": "Restaurant",
      "name": "The Uptowner Taichung",
      "url": "https://uptowner.com.tw",
      "logo": "https://uptowner.com.tw/images/logos/logo_full.svg",
      "image": "https://uptowner.com.tw/images/location_outdoor.jpg",
      "description": "Authentic American Diner experience with great food and atmosphere.",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Huamei Street, Alley 480, No. 1",
        "addressLocality": "Taichung",
        "addressRegion": "Taichung",
        "postalCode": "40360",
        "addressCountry": "Taiwan"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": "24.155377",
        "longitude": "120.660598"
      },
      "openingHours": "Mo, Tu, We, Th, Fr, Sa, Su 07:00-22:00",
      "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "+886 4 1234 5678",
        "contactType": "general"
      }
}
</script>
@endsection