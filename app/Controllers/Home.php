<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login'); // Pastikan pengguna login
        }
        return view('index'); // Halaman utama setelah login
    }

    public function krs()
    {
        return view('/krs');
    }

    public function profile()
    {
        return view('/profile');
    }

    public function bantuan()
    {
        return view('/bantuan');
    }
}
