<?php

namespace App\Http\Controllers\Admin;

use App\Menu\MenuGroup;
use App\Menu\MenuPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuPagesMenuGroupsController extends Controller
{
    public function store(MenuPage $page)
    {
        $this->validate(request(), ['group_id' => 'required|integer|exists:menu_groups,id']);

        $page->addGroup(request('group_id'));
    }

    public function delete(MenuPage $page, MenuGroup $group)
    {
        $page->releaseGroup($group);
    }
}
