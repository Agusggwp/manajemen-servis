<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Login user with username and password
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Username dan password harus diisi'], 422);
        }

        try {
            $user = User::where('username', $request->username)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json(['error' => 'Username atau password salah'], 401);
            }

            return response()->json([
                'message' => 'Login berhasil',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->username,
                    'email' => $user->email,
                    'role' => $user->role ?? 'user',
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal login: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Get current user info
     */
    public function me(Request $request)
    {
        return response()->json([
            'user' => $request->user()
        ]);
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        return response()->json(['message' => 'Logout berhasil']);
    }
}
