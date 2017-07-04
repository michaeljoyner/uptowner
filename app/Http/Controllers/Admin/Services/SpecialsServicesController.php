<?php

namespace App\Http\Controllers\Admin\Services;

use App\Specials\Special;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpecialsServicesController extends Controller
{
    public function index()
    {
        return Special::all()->map(function($special) {
            return [
                'id' => $special->id,
                'image' => $special->imageUrl('web'),
                'title' => $special->title,
                'zh_title' => $special->getTranslation('title', 'zh'),
                'description' => $special->description,
                'zh_description' => $special->getTranslation('description', 'zh'),
                'price' => $special->price,
                'start_date' => $special->start_date->format('Y-m-d'),
                'end_date' => $special->end_date->format('Y-m-d'),
                'published' => $special->published
            ];
        });
    }
}
