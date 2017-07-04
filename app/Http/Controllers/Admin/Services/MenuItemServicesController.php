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
            return [
                'id' => $item->id,
                'name' => $item->name,
                'zh_name' => $item->getTranslation('name', 'zh'),
                'description' => $item->description,
                'zh_description' => $item->getTranslation('description', 'zh'),
                'price' => $item->price,
                'is_spicy' => $item->is_spicy,
                'is_vegetarian' => $item->is_vegetarian,
                'is_recommended' => $item->is_recommended,
                'published' => $item->published,
                'image' => $item->imageUrl('thumb')
            ];;
        });
    }
}
