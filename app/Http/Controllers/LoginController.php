<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $token = $user->createToken('access_token')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'access_token' => $token
            ]);
        }
        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);
    
    }
    public function login()
    {
        return view ('login');
    }

}
