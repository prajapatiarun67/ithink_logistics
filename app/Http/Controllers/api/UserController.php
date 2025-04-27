<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\changePasswordRequest;
use App\Http\Requests\user\loginRequest;
use App\Http\Requests\user\registerRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        
    }

    public function login(loginRequest $loginRequest)
    {
        if (!Auth::attempt($loginRequest->only('email', 'password'))) {
            return response()->json(
                [
                    "success" => false,
                    "message" => 'please provide valid credentials',
                    "errors" => array()
                ], 401
            );
        }
    
        $user = User::where('email', $loginRequest->email)->first();
    
        return response()->json([
            'success'=> true,
            'message'=> "User login successfully",
            'user'  => $user,
        ]);
    }

    public function register(registerRequest $registerRequest)
    {
        $user = User::create([
            'name'     => $registerRequest->name,
            'email'    => $registerRequest->email,
            'password' => Hash::make($registerRequest->password),
        ]);
    
        return response()->json([
            'success'=> true,
            'user'  => $user,
            "message" => 'user registered successfully',
        ]);
    }

    public function change_password(changePasswordRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'user not found',
            ], 422);
        }
        // Check if current password matches
        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Current password is incorrect.',
            ], 403);
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'success' => true,
            'user'  => $user,
            'message' => 'Password updated successfully.',
        ]);
    }
}
