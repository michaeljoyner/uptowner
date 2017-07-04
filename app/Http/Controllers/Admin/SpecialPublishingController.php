<?php

namespace App\Http\Controllers\Admin;

use App\Specials\Special;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpecialPublishingController extends Controller
{
    public function update(Special $special)
    {
        $this->validate(request(), ['publish' => 'required|boolean']);

        $special->update(['published' => request('publish')]);

        return response()->json(['new_status' => $special->fresh()->published]);
    }
}
