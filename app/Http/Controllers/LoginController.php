<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Riwayat;
use App\Models\Pasien;
use App\Models\Perawat;
use App\Models\Dokter;

class LoginController extends Controller
{
    //
    public function login()
    {
        if (Auth::check()) {
            $riwayat = Riwayat::count();
            $dokter = Dokter::count();
            $pasien = Pasien::count();
            $perawat = Perawat::count();   
        return view('pages.dashboard-general-dashboard', ['type_menu' => '', 'riwayatCount' => $riwayat,
        'dokterCount' => $dokter,
        'pasienCount' => $pasien,
        'perawatCount' => $perawat,
        ]);
        }else{
            return view('pages.auth.login');
        }
    }

    public function actionlogin(Request $request)
    {
        $riwayat = Riwayat::count();
        $dokter = Dokter::count();
        $pasien = Pasien::count();
        $perawat = Perawat::count();
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
           
    return view('pages.dashboard-general-dashboard', ['type_menu' => '', 'riwayatCount' => $riwayat,
    'dokterCount' => $dokter,
    'pasienCount' => $pasien,
    'perawatCount' => $perawat,
]);
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
