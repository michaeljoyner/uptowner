<?php

namespace App\Http\Controllers\Admin;

use App\Specials\Special;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpecialsController extends Controller
{

    public function index()
    {
        return view('admin.specials.index');
    }

    public function store()
    {
        $this->validate(request(), [
            'title' => 'required_without:zh_title',
            'zh_title' => 'required_without:title',
        ]);

        Special::createWithTranslations(request()->all());
    }

    public function update(Special $special)
    {
        $this->validate(request(), [
            'title' => 'required_without:zh_title',
            'zh_title' => 'required_without:title',
        ]);

        $special->updateWithTranslations(request()->all());

        $special = $special->fresh();

        return [
            'title' => $special->title,
            'zh_title' => $special->getTranslation('title', 'zh'),
            'description' => $special->description,
            'zh_description' => $special->getTranslation('description', 'zh'),
            'price' => $special->price,
            'start_date' => $special->start_date->format('Y-m-d'),
            'end_date' => $special->end_date->format('Y-m-d')
        ];
    }

    public function delete(Special $special)
    {
        $special->delete();
    }
}
