<?php

namespace App\Http\Controllers\Admin\Services;

use App\Menu\MenuGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuItemServicesController extends Controller
{
    public function index(MenuGroup $group)
    {
        return $group->items->map(function($item) {
            return array_merge($item->toArray(), [
                'thumb_src' => $item->imageUrl('thumb'),
                'web_src' => $item->imageUrl('web'),
                'image_src' => $item->imageUrl()
            ]);
        });
    }
}
