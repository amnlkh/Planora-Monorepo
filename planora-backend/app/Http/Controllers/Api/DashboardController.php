<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data user yang telah ditempelkan oleh middleware kustom Anda
        // Catatan: Sesuaikan 'authenticated_user' dengan key yang Anda gunakan di AuthMiddleware
        $user = $request->attributes->get('authenticated_user'); 

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User tidak terautentikasi.'
            ], 401);
        }

        return response()->json([
            'status' => 'success',
            'user' => [
                'name' => $user->name,
                'email' => $user->email
            ]
        ], 200);
    }
}