<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function loginProses(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:8',
        ], [
            'username.required' => 'Username Tidak Boleh Kosong',
            'password.required' => 'Password Tidak Boleh Kosong',
            'password.min' => 'Password Minimal 8 Karakter',
        ]);
        $data = array(
            'username' => $request->username,
            'password' => $request->password,
        );
        if (Auth::attempt($data)) {
            return redirect()->route('dashboard')->with('success', 'Anda Berhasil Login');
        } else {
            return redirect()->back()->with('error', 'Username Atau Password Salah!');
        }
    }
    public function logout()
    {

        Auth::logout();
        return redirect()->route('login')->with('success', 'Anda Berhasil Logout');
    }

}
