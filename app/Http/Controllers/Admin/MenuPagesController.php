<?php

namespace App\Http\Controllers\Admin;

use App\Menu\MenuPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuPagesController extends Controller
{

    public function index()
    {
        return view('admin.menu.pages.index');
    }

    public function show(MenuPage $page)
    {
        return view('admin.menu.pages.show', ['page' => $page]);
    }

    public function store()
    {
        $this->validate(request(), [
            'name' => 'required'
        ]);

        return MenuPage::createWithTranslations(request(['name', 'zh_name']));
    }

    public function update(MenuPage $page)
    {
        $this->validate(request(), [
            'name' => 'required'
        ]);

        $page->updateWithTranslations(request(['name', 'zh_name']));

        return $page->fresh()->toJsonableArray();
    }

    public function delete(MenuPage $page)
    {
        $page->delete();
    }
}
