<?php

namespace App\Http\Controllers\Admin;

use App\Specials\Special;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpecialImagesController extends Controller
{
    public function store(Special $special)
    {
        $this->validate(request(), ['image' => 'required|image']);

        $image = $special->setImage(request('image'));
    }
}
