<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuPageController extends Controller
{
    public function show()
    {
        return view('front.menu.page');
    }
}
