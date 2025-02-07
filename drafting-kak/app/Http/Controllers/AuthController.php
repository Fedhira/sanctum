<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{

    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }
    // **Login API**
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        // Redirect berdasarkan role
        $redirectUrl = match ($user->role) {
            'admin' => '/admin/index',
            'supervisor' => '/supervisor/index',
            'staff' => '/user/index',
            default => '/login'
        };

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'role' => $user->role
            ],
            'redirect' => $redirectUrl
        ]);
    }



    // **Logout API**
    public function logout(Request $request)
    {
        $user = $request->user();

        if ($user) {
            $user->tokens()->delete(); // Hapus semua token user
        }

        return response()->json(['message' => 'Logged out successfully']);
    }
}
