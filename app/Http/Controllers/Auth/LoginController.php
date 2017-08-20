<?php

namespace App\Http\Controllers\Auth;

//use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'check']);
    }

    /**
     * Checks if the user is authenticated and returns a boolean value.
     */
    public function check()
    {
        return ['is_authenticated' => Auth::check()];
    }

    /**
     * Logs the user in.
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['name' => $request->input('name'), 'password' => $request->input('password')], true)) {
            return $this->check();
        } else {
            return response(['name' => 'Anmeldung fehlgeschlagen. Die Benutzerdaten stimmen nicht überein.'], 422);
        }
    }

    /**
     * Logs the user out.
     */
     public function logout()
     {
        Auth::logout();
        return $this->check();
     }
}
