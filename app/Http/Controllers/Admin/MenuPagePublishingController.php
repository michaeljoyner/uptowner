<?php

namespace App\Http\Controllers\Admin;

use App\Menu\MenuPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuPagePublishingController extends Controller
{
    public function update(MenuPage $page)
    {
        $this->validate(request(), ['publish' => 'required|boolean']);

        $page->update(['published' => request('publish')]);

        return response()->json(['new_status' => $page->fresh()->published]);
    }
}
