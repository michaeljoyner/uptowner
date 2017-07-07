<?php

namespace App\Http\Controllers\Admin\Services;

use App\Menu\FeaturedItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeaturedMenuItemsServiceController extends Controller
{
    public function index()
    {
        return FeaturedItem::latest()->get()->map(function($item) {
            return $item->menuItem->presentAttributes();
        });
    }
}
