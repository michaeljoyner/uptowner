@extends('front.base', ['pageName' => 'menu-page'])

@section('content')
    <div class="menu-nav zz-top bg-light flex flex-space text-colour uppercase pd-y-4 heading bb-2 bd-col">
        @foreach(Menu::pages() as $page)
            <scroll-link hash-link="#{{ str_slug($page->name) }}" link-text="{{ $page->name }}"></scroll-link>
        @endforeach
    </div>
    @foreach(Menu::pages() as $page)
    <section class="pb-7" id="{{ str_slug($page->name) }}">
        <div class="flex flex-center pd-y-9 bg-pattern-grey btb-2 bd-col">
            <h1 class="h1 uppercase text-colour text-center">{{ $page->name }}</h1>
        </div>
        @if($page->publishedItemImages()->count() > 2)
        <div data-flickity='{"cellAlign": "left", "contain": true, "groupCells": true, "imagesLoaded": true, "pageDots": false}'>
            @foreach($page->getFilledImageRow() as $image)
                <div class="relative of-hidden">
                    <img draggable="false" width="290" src="{{ $image['src'] }}" alt="{{ $image['alt'] }}">
                    <p class="menu-image-title absolute-bottom pd-2 one-liner text-colour-light h6">{{ $image['alt'] }}</p>
                </div>
            @endforeach
        </div>
        @endif
        <div class="w-con mg-x-a">
            @foreach($page->publishedGroups()->ordered() as $group)
                <p class="h2 text-center uppercase pd-y-7">{{ $group->name }}</p>
                @foreach($group->publishedItems()->ordered() as $item)
                    <article class="pd-y-4 mg-x-4">
                        <div class="h3 mb-2">
                            {{ $item->name }}
                            @if($item->is_vegetarian)
                                <span class="menu-icon vegetarian">@include('svgicons.vegetarian')</span>
                            @endif
                            @if($item->is_spicy)
                                <span class="menu-icon spicy">@include('svgicons.spicy')</span>
                            @endif
                            @if($item->is_recommended)
                                <span class="menu-icon recommended">@include('svgicons.recommended')</span>
                            @endif
                        </div>
                        <p class="body-text mb-2 mt-0 text-constrain">{{ $item->description }}</p>
                        <p class="h4 text-colour-soft">NT${{ $item->price }}</p>
                    </article>
                @endforeach
            @endforeach
        </div>
    </section>
    @endforeach
@endsection
