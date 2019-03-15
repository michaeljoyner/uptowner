<?php

namespace App\Http\Controllers;

use App\Menu\FeaturedItem;
use App\Specials\Special;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function show()
    {
        $favourites = FeaturedItem::currentlyFeatured();
        $specials = Special::current();

        return view('front.home.page', [
            'favourites' => $favourites,
            'specials' => $specials,
        ]);
    }
}
