<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function show_login()
    {
        return view("login");
    }

    public function login(Request $request)
    {
        $email = $request->input("email");
        $password = $request->input("password");

        // Ambil data dari file config yang membaca .env
        $adminEmail = config("services.admin.email");
        $adminPassword = config("services.admin.password");

        // Cek kecocokan email dan password
        if ($email === $adminEmail && $password === $adminPassword) {
            // Amankan ID sesi dari peretasan (Session Fixation)
            $request->session()->regenerate();

            // Simpan tanda login di session
            session(["user_id" => 1, "user_email" => $email]);

            return redirect("/buku");
        }

        return back()->with("error", "Email atau password salah");
    }

    public function logout(Request $request)
    {
        if ($request->session()) {
            $request->session()->flush();
            return redirect("/login");
        }
    }
}
