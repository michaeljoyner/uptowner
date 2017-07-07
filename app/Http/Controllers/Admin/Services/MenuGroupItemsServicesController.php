<?php

namespace App\Http\Controllers\Admin\Services;

use App\Menu\MenuGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuGroupItemsServicesController extends Controller
{
    public function index(MenuGroup $group)
    {
        return $group->items->map(function($item) {
            return $item->presentAttributes();
        });
    }
}
