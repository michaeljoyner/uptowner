<?php

namespace App\Http\Controllers\Admin\Services;

use App\Menu\MenuPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuPagesServiceController extends Controller
{
    public function index()
    {
        return MenuPage::all()->map(function($page) {
            return [
                'id' => $page->id,
                'name' => $page->name,
                'zh_name' => $page->getTranslation('name', 'zh')
            ];
        });
    }
}
