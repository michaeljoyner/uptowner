<?php

namespace App\Http\Controllers\Admin\Services;

use App\Menu\MenuPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuPagesMenuGroupsServicesController extends Controller
{
    public function index(MenuPage $page)
    {
        return $page->groups->map(function($group) {
            return [
                'id' => $group->id,
                'name' => $group->name,
                'zh_name' => $group->getTranslation('name', 'zh'),
                'description' => $group->description,
                'zh_description' => $group->getTranslation('description', 'zh'),
                'is_assigned' => !! $group->page,
                'page_name' => $group->page->name ?? null,
                'page_id' => $group->page->id ?? null,
            ];
        });
    }
}
