<?php

namespace App\Http\Controllers\Admin;

use App\Menu\MenuItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuItemTogglesController extends Controller
{
    public function publish(MenuItem $item)
    {
        return $this->toggleAndRespond('published', $item);
    }

    public function spicy(MenuItem $item)
    {
        return $this->toggleAndRespond('is_spicy', $item);
    }

    public function vegetarian(MenuItem $item)
    {
        return $this->toggleAndRespond('is_vegetarian', $item);
    }

    public function recommended(MenuItem $item)
    {
        return $this->toggleAndRespond('is_recommended', $item);
    }

    private function toggleAndRespond($toggle_attribute, $menu_item)
    {
        $this->validate(request(), [$toggle_attribute => 'required|boolean']);

        $menu_item->update([$toggle_attribute => request($toggle_attribute)]);

        return response()->json(['new_status' => $menu_item->fresh()->{$toggle_attribute}]);
    }
}
