<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
}
