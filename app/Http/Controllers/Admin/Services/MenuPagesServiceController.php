<?php

namespace App\Http\Controllers\Admin\Services;

use App\Menu\MenuPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuPagesServiceController extends Controller
{
    public function index()
    {
        return MenuPage::all()->map->toJsonableArray();
    }
}
