@extends('front.base', ['pageName' => 'menu-page'])

@section('content')
    <div class="menu-nav zz-top bg-light flex flex-space text-colour uppercase pd-y-4 heading bb-2 bd-col">
        @foreach(Menu::pages() as $page)
            <scroll-link hash-link="#{{ str_slug($page->name) }}" link-text="{{ $page->name }}"></scroll-link>
        @endforeach
    </div>
    @foreach(Menu::pages() as $page)
    <section class="pb-7" id="{{ str_slug($page->name) }}">
        <div class="flex flex-center pd-y-9 bg-pattern-grey bt-2 bd-col">
            <h1 class="h1 uppercase text-colour text-center">{{ $page->name }}</h1>
        </div>
        <div data-flickity='{"cellAlign": "left", "contain": true, "groupCells": true, "imagesLoaded": true, "pageDots": false}'>
            @foreach($page->publishedItemImages() as $image)
                <div class="relative">
                    <img draggable="false" width="290" src="{{ $image['src'] }}" alt="{{ $image['alt'] }}">
                    <p class="absolute-bottom-right text-colour-light h4">{{ $image['alt'] }}</p>
                </div>
            @endforeach
        </div>
        <div class="w-con mg-x-a">
            @foreach($page->publishedGroups()->ordered() as $group)
                <p class="h3 text-center uppercase pd-y-7">{{ $group->name }}</p>
                @foreach($group->publishedItems()->ordered() as $item)
                    <article class="pd-y-4 mg-x-4">
                        <p class="h3 mb-2">{{ $item->name }}</p>
                        <p class="body-text mg-y-2">{{ $item->description }}</p>
                        <p class="h3 text-colour">NT${{ $item->price }}</p>
                    </article>
                @endforeach
            @endforeach
        </div>
    </section>
    @endforeach
@endsection
