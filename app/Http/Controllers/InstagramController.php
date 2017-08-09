<?php

namespace App\Http\Controllers;

use App\Facades\Instagram;
use Illuminate\Http\Request;

class InstagramController extends Controller
{
    public function index()
    {
        return Instagram::recent()->take(10);
    }
}
