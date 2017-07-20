<?php

namespace App\Http\Controllers\Admin;

use App\Menu\MenuGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuGroupController extends Controller
{
    public function index()
    {
        return view('admin.menu.groups.index');
    }

    public function show(MenuGroup $group)
    {
        return view('admin.menu.groups.show')->with(compact('group'));
    }

    public function store()
    {
        $this->validate(request(), [
            'name' => 'required',
        ]);

        $group = MenuGroup::createWithTranslations(request()->all());

        return $group;
    }

    public function update(MenuGroup $group)
    {
        $this->validate(request(), [
            'name' => 'required',
        ]);
        $group->updateWithTranslations(request()->all());
        $group = $group->fresh();

        return response()->json([
            'id' => $group->id,
            'name' => $group->name,
            'zh_name' => $group->getTranslation('name', 'zh'),
            'description' => $group->description,
            'zh_description' => $group->getTranslation('description', 'zh')
        ]);
    }
}
