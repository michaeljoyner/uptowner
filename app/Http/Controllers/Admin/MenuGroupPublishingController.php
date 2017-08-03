<?php

namespace App\Http\Controllers\Admin;

use App\Menu\MenuGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuGroupPublishingController extends Controller
{
    public function update(MenuGroup $group)
    {
        $this->validate(request(), ['publish' => 'required|boolean']);

        $group->update(['published' => request('publish')]);

        return response()->json(['new_status' => $group->fresh()->published]);
    }
}
