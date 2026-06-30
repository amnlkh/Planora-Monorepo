<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Schedule;

class ScheduleApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test user bisa membuat jadwal
     */
    public function test_authenticated_user_can_create_schedule(): void
    {
        $user = User::factory()->create();

        // Mengirim data yang sesuai dengan aturan validasi di Controller
        $response = $this->actingAs($user)->postJson('/api/schedules', [
            'title'      => 'Rapat Proyek',
            'date'       => '2026-06-27', 
            'start_time' => '09:00',
            'end_time'   => '10:00', // Wajib ada karena 'after:start_time'
            'note'       => 'Diskusi proyek backend',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('schedules', ['title' => 'Rapat Proyek']);
    }

    /**
     * Test user bisa melihat daftar jadwalnya sendiri
     */
    public function test_authenticated_user_can_view_schedules(): void
    {
        $user = User::factory()->create();
        
        // Pastikan ScheduleFactory sudah disesuaikan dengan field terbaru
        Schedule::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->getJson('/api/schedules');

        $response->assertStatus(200)
                 ->assertJsonCount(1, 'data'); // Menyesuaikan dengan struktur respons JSON Anda
    }
}