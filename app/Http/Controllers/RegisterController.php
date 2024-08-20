<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function registerUser(Request $request)
{
    $validator = Validator::make($request->all(), [
        'first_name' => 'required',
        'last_name' => 'required',
        'role' => 'nullable',
        'address' => 'required',
        'phone' => 'required|digits:11',
        'profile_pic' => 'nullable|mimes:jpg,png|max:2048', 
        'email' => 'required|email',
        'password' => 'required|min:8',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }
    if ($request->hasFile('profile_pic')) {
        $file = $request->file('profile_pic');
        $profilePicPath = $file->store('profile_pics', 'public');
    } else {
        $profilePicPath = null;
    }

    $user = User::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'role' => $request->role,
        'address' => $request->address,
        'phone' => $request->phone,
        'profile_pic' => $profilePicPath, 
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);
    if($user){
        $token = $user->createToken('access_token')->plainTextToken;
                  

        return response()->json([
            'status' => 'success',
            'access_token' => $token,
            'role' => $user->role,
            'message' => 'User registered successfully', 'user' => $user, 201,
        ]);
    }
    return response()->json(['message' => 'Unsuccessful!']);
}
public function register()
    {
        return view('register');
    }
}
