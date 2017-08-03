<?php

namespace App\Http\Controllers\Admin\Services;

use App\Menu\MenuGroup;
use App\Menu\MenuPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuGroupsOrderController extends Controller
{

    public function update(MenuPage $page)
    {
        $this->validate(request(), [
            'order' => 'required|array',
            'order.*' => 'integer|exists:menu_groups,id'
        ]);

        MenuGroup::setOrder(request('order'));
    }
}
