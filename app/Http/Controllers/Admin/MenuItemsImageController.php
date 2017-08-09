<?php

namespace App\Http\Controllers\Admin;

use App\Menu\MenuItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuItemsImageController extends Controller
{
    public function store(MenuItem $item)
    {
        $this->validate(request(), ['image' => 'required|image']);

        $item->setImage(request('image'));

        return $item->fresh()->imageInfoArray();
    }
}
