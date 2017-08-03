<?php

namespace App\Http\Controllers\Admin\Services;

use App\Menu\MenuGroup;
use App\Menu\MenuItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuItemsOrderController extends Controller
{
    public function update(MenuGroup $group)
    {
        $this->validate(request(), [
            'order' => 'required|array',
            'order.*' => 'integer|exists:menu_items,id'
        ]);

        MenuItem::setOrder(request('order'));
    }
}
