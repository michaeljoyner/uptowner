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
        $item = $item->fresh();

        return [
            'name' => $item->name,
            'zh_name' => $item->getTranslation('name', 'zh'),
            'description' => $item->description,
            'zh_description' => $item->getTranslation('description', 'zh'),
            'price' => $item->price,
            'is_spicy' => $item->is_spicy,
            'is_vegetarian' => $item->is_vegetarian,
            'is_recommended' => $item->is_recommended,
            'published' => $item->published
        ];
    }


    public function delete(MenuItem $item)
    {
        $item->delete();
    }
}
