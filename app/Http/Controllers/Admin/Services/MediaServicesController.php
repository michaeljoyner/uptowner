<?php

namespace App\Http\Controllers\Admin\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\MediaLibrary\Models\Media;

class MediaServicesController extends Controller
{
    public function delete(Media $media)
    {
        $media->delete();
    }
}
