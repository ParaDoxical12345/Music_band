<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function login()
    {
        return view( 'components.login');
    }

    public function logout()
    {
        return view( 'components.logout');
    }

    public function register()
    {
        return view( 'components.register');
    }

}
