<?php

namespace App\Http\Controllers;

class IndexController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('index');
    }

    public function logout()
    {
        session()->flush();

        auth()->logout();

        return redirect()->route('auth.login.create');
    }
}
