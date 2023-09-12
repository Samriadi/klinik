<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class LoginController extends Controller
{
    //
    public function login()
    {
        if (Auth::check()) {
            return view('pages.dashboard-general-dashboard', ['type_menu' => 'dashboard']);
        }else{
            return view('pages.auth.login');
        }
    }

    public function actionlogin(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return view('pages.dashboard-general-dashboard', ['type_menu' => '']);
            // dd($credentials);
        }else{
            return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
        }
    }

    public function actionlogout()
    {
        Auth::logout();
        return redirect('/');
    }

}
