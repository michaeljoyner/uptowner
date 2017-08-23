<?php

namespace App\Http\Controllers\Admin\Services;

use App\Specials\Special;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpecialsServicesController extends Controller
{
    public function index()
    {
        return Special::all()->map->toJsonableArray();
    }
}
