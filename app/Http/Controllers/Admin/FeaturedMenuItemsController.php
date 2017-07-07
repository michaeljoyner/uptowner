<?php

namespace App\Http\Controllers\Admin;

use App\Menu\MenuItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeaturedMenuItemsController extends Controller
{

    public function index()
    {
        return view('admin.menu.featured.index');
    }

    public function update()
    {
        $this->validate(request(), ['id' => 'required|integer|exists:menu_items,id']);

        MenuItem::find(request('id'))->feature();
    }

    public function delete($menuItemId)
    {
        MenuItem::findOrFail($menuItemId)->demote();
    }
}
