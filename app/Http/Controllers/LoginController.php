<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller {
    public function login(Request $request)
{
    // $user = User::where('email', 'admin@colors2cart.in')->first();
    //     $user->password = Hash::make('12345');
    //     $user->save();
    $email = $request->username;
    $password = $request->password;

    Log::info("Login attempt for: $email");

    $user = User::where('user_id', $email)->first();

    if (!$user) {
        Log::error("User not found: $email");
        return response()->json([
            'status' => 'error',
            'message' => 'User Not Available',
        ], 400);
    }

    Log::info("User found: " . $user->email);
    Log::info("Stored password: " . $user->password);

    try {
        if (Hash::check($password, $user->password)) {
            Log::info("Password matched via Bcrypt");
            Auth::login($user);
            return response()->json([
                'status' => 200,
                'message' => 'User Login Successfully',
            ]);
        }
    } catch (\RuntimeException $e) {
        Log::warning("Password check failed, trying plain-text. Error: " . $e->getMessage());

        if ($user->password === $password) {
            Log::info("Plain-text password matched. Rehashing...");
            $user->password = Hash::make($password);
            $user->save();

            Auth::login($user);
            return response()->json([
                'status' => 200,
                'message' => 'User Login Successfully (Password Rehashed)',
            ]);
        }
    }

    Log::error("Login failed: Invalid credentials");
    return response()->json([
        'status' => 401,
        'message' => 'Invalid Credentials',
    ]);
}


    public function logout( Request $request ) {
        try {
            Auth::logout();

            return response()->json( [
                'status'=>'200',
                'Message'=>'User Logged out Successfully',
            ] );
        } catch ( \Throwable $th ) {
            return response()->json( [
                'status'=>'500',
                'Message'=>'Failed to Log out',
            ] );
        }
    }
}