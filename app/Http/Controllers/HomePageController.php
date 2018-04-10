<?php

namespace App\Http\Controllers;

use App\Instagram\Instagram;
use App\Menu\FeaturedItem;
use App\Specials\Special;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function show(Instagram $instagram)
    {
        $favourites = FeaturedItem::currentlyFeatured();
        $specials = Special::current();
        $instagrams = $instagram->fetch(['username' => 'uptownertaichung']);

        return view('front.home.page', [
            'favourites' => $favourites,
            'specials' => $specials,
            'instagrams' => $instagrams
        ]);
    }
}
