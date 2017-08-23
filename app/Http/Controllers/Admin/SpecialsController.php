<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SpecialsForm;
use App\Specials\Special;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpecialsController extends Controller
{

    public function index()
    {
        return view('admin.specials.index');
    }

    public function store(SpecialsForm $form)
    {
        Special::createWithTranslations($form->sanitizedData());
    }

    public function update(Special $special, SpecialsForm $form)
    {
        $special->updateWithTranslations($form->sanitizedData());

        return $special->fresh()->toJsonableArray();
    }

    public function delete(Special $special)
    {
        $special->delete();
    }
}
