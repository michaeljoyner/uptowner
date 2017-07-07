<?php

namespace App\Http\Controllers\Admin\Services;

use App\Menu\MenuItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuItemsServiceController extends Controller
{
    public function index()
    {
        return MenuItem::all()->map(function($item) {
            return $item->presentAttributes();
        });
    }
}
