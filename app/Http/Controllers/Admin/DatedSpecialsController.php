<?php

namespace App\Http\Controllers\Admin;

use App\Specials\Special;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DatedSpecialsController extends Controller
{
    public function delete(Special $special)
    {
        $special->update([
            'start_date' => null,
            'end_date' => null
        ]);
    }
}
