<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class TaskApiTest extends TestCase
{
    use RefreshDatabase;

    private function createDummyUser()
    {
        return User::create([
            'name' => 'Test User',
            'email' => 'test@planora.com',
            'password' => Hash::make('password')
        ]);
    }

    public function test_unauthenticated_user_cannot_access_tasks_api(): void
    {
        $response = $this->getJson('/api/tasks');
        $response->assertStatus(401);
    }

    public function test_authenticated_user_can_create_task_via_api(): void
    {
        $user = $this->createDummyUser();

        // Gunakan actingAs() standar Laravel. 
        // Agar middleware Anda mengenali user ini, pastikan AuthMiddleware
        // di backend membaca Auth::user() jika token tidak ada (saat testing).
        $response = $this->actingAs($user)->postJson('/api/tasks', [
            'title'       => 'Belajar Unit Testing',
            'description' => 'Materi testing Laravel',
            'deadline'    => now()->addDays(5)->format('Y-m-d'),
            'status'      => 'pending'
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('tasks', ['title' => 'Belajar Unit Testing']);
    }

    public function test_create_task_fails_if_title_is_missing(): void
{
    $user = $this->createDummyUser();
    
    // Tambahkan ->dump() untuk melihat isi respons jika gagal
    $response = $this->actingAs($user)->postJson('/api/tasks', [
        'description' => 'Tanpa judul',
    ]);

    // Jika gagal, ini akan menampilkan apa yang dikembalikan server
    $response->assertStatus(422); 
    }
}