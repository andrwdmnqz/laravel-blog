<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {

        $inputFields = $request->validate([
            'email' => 'required|email|unique:users,email',
            'name' => 'required|unique:users,name|min:3|max:30',
            'password' => 'required|confirmed|min:4|max: 30'
        ]);

        $inputFields['password'] = Hash::make($inputFields['password']);

        $user = User::create($inputFields);

        auth()->login($user);

        return response()->json([
            'message' => 'User created successfully',
            'token' => $user->createToken("API TOKEN")->plainTextToken
        ], 201);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json([
            'message' => 'Logged out'
        ], 200);
    }

    public function login(Request $request)
    {
        $inputFields = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($inputFields)) {
            $user = Auth::user();
            $token = $user->createToken("API TOKEN")->plainTextToken;

            return response()->json([
                'message' => 'Logged in successfully',
                'token' => $token
            ],200);
        }

        return response()->json([
            'error_text' => 'Wrong email or password.'
        ], 401);
    }
}
