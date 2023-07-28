<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index(Request $request) {
        if ($request->session()->get('password') === env('APP_PASSWORD', '123456789')) {
            return redirect(route('versions.index'));
        }

        return view('login');
    }

    public function login(Request $request) {
        if (!$request->password) {
            return back()->withErrors(['password' => 'Пароль не указан']);
        }

        if ($request->password !== env('APP_PASSWORD', '123456789')) {
            return back()->withErrors(['password' => 'Неверный пароль']);
        }

        $request->session()->put('password', $request->password);
        return redirect(route('versions.index'));
    }
}
