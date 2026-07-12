<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->input("email");
        $password = $request->input("password");

        $user = DB::select("SELECT id, email, password FROM users WHERE email = ?", [$email]);
        if ($user && Hash::check($password, $user[0]->password)) {
            session(["user_id" => $user[0]->id, "user_email" => $user[0]->email]);
            return redirect("/dashboard");
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
