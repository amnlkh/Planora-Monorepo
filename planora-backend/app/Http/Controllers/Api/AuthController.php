<?php

namespace App\Http\Controllers\Api;

use App\Contracts\AuthServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected AuthServiceInterface $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function register(Request $request)
{
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:100'],
        'email' => ['required', 'string', 'email', 'max:150', 'unique:users,email'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    // 1. Membuat user baru melalui service layer Anda
    $user = $this->authService->register($validated);

    // 2. Membuat token acak kustom sepanjang 80 karakter
    $plainToken = \Illuminate\Support\Str::random(80);

    // 3. Menyimpan hash token ke tabel access_tokens Anda
    \App\Models\AccessToken::create([
        'user_id' => $user->id,
        'token_hash' => hash('sha256', $plainToken),
        'expires_at' => now()->addDays(7),
        'revoked_at' => null,
    ]);

    // 4. Mengembalikan respons JSON lengkap dengan string token
    return response()->json([
        'status' => 'success',
        'message' => 'Registrasi berhasil',
        'token' => $plainToken, // <-- Token dikirim langsung di baris utama
        'data' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'created_at' => $user->created_at,
        ]
    ], 201);
}

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $data = $this->authService->login($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Login berhasil',
            'data' => $data,
        ]);
    }

    public function logout()
    {
        $this->authService->logout();

        return response()->json([
            'status' => 'success',
            'message' => 'Logout berhasil',
        ]);
    }
}