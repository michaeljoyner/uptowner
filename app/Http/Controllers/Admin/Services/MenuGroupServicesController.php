<?php

namespace App\Http\Controllers\Admin\Services;

use App\Menu\MenuGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuGroupServicesController extends Controller
{
    public function index()
    {
        return MenuGroup::all()->map(function($group) {
            return [
                'id' => $group->id,
                'name' => $group->name,
                'zh_name' => $group->getTranslation('name', 'zh'),
                'description' => $group->description,
                'zh_description' => $group->getTranslation('description', 'zh'),
                'published' => $group->published,
                'is_assigned' => !! $group->page,
                'page_name' => $group->page->name ?? null,
                'page_id' => $group->page->id ?? null,
                'can_delete' => $group->canBeDeleted()
            ];
        });
    }
}
