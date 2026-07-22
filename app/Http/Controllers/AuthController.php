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

        if ($email  !== "SiPustaka@gmail.com" && $password !== "sipustakamajuterus") {
            return back()->with("error", "Email atau password salah");
        }

        session(["user_id" => 1, "user_email" => $email]);
        return redirect("/dashboard");
    }

    public function logout(Request $request)
    {
        if ($request->session()) {
            $request->session()->flush();
            return redirect("/login");
        }
    }
}
