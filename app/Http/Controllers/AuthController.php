<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\GenerateToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        # - User Not Found :
        if (!$user)  return response()->json(["error" => "email not found"], 401);

        # - Wrong Credentials :
        if (!Hash::check($request->password, $user->password)) return response()->json([
            "error" => "Password incorrect"
        ], 401);

        # - Valid Credentials :
        $token = GenerateToken::new($user);
        Cookie::queue('token', $token, 60);
        return response()->json([
            "success" => "Welcome " . $user->username,
            "token" => $token,
            "user" => $user
        ], 200);
    }

}
