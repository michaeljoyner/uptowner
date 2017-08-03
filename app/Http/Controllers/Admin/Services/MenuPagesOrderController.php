<?php

namespace App\Http\Controllers\Admin\Services;

use App\Menu\MenuPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuPagesOrderController extends Controller
{


    public function update()
    {
        $this->validate(request(), [
            'order' => 'required|array',
            'order.*' => 'integer|exists:menu_pages,id'
        ]);

        MenuPage::setOrder(request('order'));
    }
}
