<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersPasswordController extends Controller
{

    public function edit()
    {
        return view('admin.users.passwords.edit');
    }

    public function update()
    {
        $this->validate(request(), [
            'old_password' => 'required|password',
            'password' => 'required|min:6|confirmed'
        ]);

        request()->user()->resetPassword(request('password'));

        return redirect('/admin');
    }
}
