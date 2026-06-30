<?php

namespace App\Services;

use App\Contracts\AuthServiceInterface;
use App\Models\AccessToken;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthService implements AuthServiceInterface
{
    public function register(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function login(array $credentials): array
    {
        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            abort(401, 'Email atau password salah');
        }

        $plainToken = Str::random(80);

        AccessToken::create([
            'user_id' => $user->id,
            'token_hash' => hash('sha256', $plainToken),
            'expires_at' => now()->addDays(7),
            'revoked_at' => null,
        ]);

        return [
            'token' => $plainToken,
            'token_type' => 'Bearer',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ];
    }

    public function logout(): bool
    {
        $token = request()->bearerToken();

        if (!$token) {
            abort(401, 'Token tidak valid atau sudah kedaluwarsa');
        }

        $accessToken = AccessToken::where('token_hash', hash('sha256', $token))
            ->whereNull('revoked_at')
            ->first();

        if (!$accessToken) {
            abort(401, 'Token tidak valid atau sudah kedaluwarsa');
        }

        $accessToken->update([
            'revoked_at' => now(),
        ]);

        return true;
    }
}