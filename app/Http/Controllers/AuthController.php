<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;

class AuthController extends Controller
{
    public function login () 
    {
        if(Auth::check()) {
            return redirect()->route('dashboard.index'); // atau sesuaikan dengan nama rute dashboard jika berbeda
        }
        return view('pages.auth.login');
    }

    public function auth_login (Request $request)
    {
        try {
            $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);
            if (Auth::attempt($request->only('username', 'password'))) {
                return redirect()
                    ->route('dashboard.index');
            }
            return redirect()
                ->back()
                ->withErrors(['message' => 'Ups! Username atau password dimasukkan tidak sesuai']);

        } catch (\Throwable $th) {
            info('Exception' . $th->getMessage());
            return redirect()
                ->back()
                ->withErrors(['message' => $th->getMessage()]);
        }
    }
    public function logout()
    {
        FacadesSession::flush();
        Auth::logout();

        return redirect()->route('login');
    }

}
