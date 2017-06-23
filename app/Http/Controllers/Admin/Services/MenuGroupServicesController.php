<?php

namespace App\Http\Controllers\Admin\Services;

use App\Menu\MenuGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuGroupServicesController extends Controller
{
    public function index()
    {
        return MenuGroup::all();
    }
}
