<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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
    public function registerUser(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'role' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'profile_pic' =>'required',
            'email' => 'required',
            'password' => 'required|min:8',
            
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'role' => $request->role,
            'address' => $request->address,
            'phone' => $request->phone,
            'profile_pic' =>$request->profile_pic,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            
           
        ]);

        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }
    public function showUsers()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function login()
    {
        return view ('login');
    }
    public function welcome()
    {
        return view('welcome');
    }

    public function register()
    {
        return view('register');
    }
}
