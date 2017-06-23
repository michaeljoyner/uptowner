<?php

namespace App\Http\Controllers\Admin;

use App\Menu\MenuGroup;
use App\Menu\MenuItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuItemsController extends Controller
{
    public function store(MenuGroup $group)
    {
        $this->validate(request(), [
            'name' => 'required_without:zh_name',
            'zh_name' => 'required_without:name'
        ]);
        $item = $group->addItem(request()->all());

        return $item;
    }

    public function update(MenuItem $item)
    {
        $item->updateWithTranslations(request()->all());

        return request()->isJson() ? $item->fresh() : redirect('/admin');
    }


    public function delete(MenuItem $item)
    {
        $item->delete();
    }
}
