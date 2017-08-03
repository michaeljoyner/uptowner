<?php

namespace App\Http\Controllers\Admin\Services;

use App\Facades\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuOrderedListsController extends Controller
{
    public function show()
    {
        return Menu::orderedLists();
    }
}
