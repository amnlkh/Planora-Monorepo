<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use App\Contracts\TaskServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class TaskServiceTest extends TestCase
{
    use RefreshDatabase;

    protected TaskServiceInterface $taskService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->taskService = $this->app->make(TaskServiceInterface::class);
    }

    /**
     * Helper untuk membuat user dummy tanpa factory
     */
    private function createDummyUser()
    {
        return User::create([
            'name' => 'Test User',
            'email' => 'testuser_' . uniqid() . '@example.com',
            'password' => Hash::make('password123')
        ]);
    }

    /**
     * 1. TEST MENAMBAH TUGAS (STORE)
     */
    public function test_it_can_create_a_task(): void
    {
        $user = $this->createDummyUser();

        $taskData = [
            'user_id'     => $user->id,
            'title'       => 'Menyusun Proposal Sempro',
            'description' => 'Mengerjakan draft bab 1 sampai bab 3',
            'deadline'    => now()->addDays(7)->format('Y-m-d H:i:s'),
            'status'      => 'pending',
        ];

        $createdTask = $this->taskService->createTask($taskData);

        $this->assertInstanceOf(Task::class, $createdTask);
        $this->assertEquals($taskData['title'], $createdTask->title);
        
        $this->assertDatabaseHas('tasks', [
            'user_id' => $user->id,
            'title'   => 'Menyusun Proposal Sempro'
        ]);
    }

    /**
     * 2. TEST MENGAMBIL SEMUA TUGAS (INDEX)
     */
    public function test_it_can_get_all_tasks_for_user(): void
    {
        $user = $this->createDummyUser();

        // Membuat 3 tugas dummy manual lewat Eloquent
        for ($i = 1; $i <= 3; $i++) {
            Task::create([
                'user_id' => $user->id,
                'title' => "Tugas Kuliah Ke-$i",
                'description' => 'Deskripsi tugas',
                'deadline' => now()->addDays($i)->format('Y-m-d H:i:s'),
                'status' => 'pending'
            ]);
        }

        $fetchedTasks = $this->taskService->getAllTasks(['user_id' => $user->id]);

        $this->assertCount(3, $fetchedTasks);
    }

    /**
     * 3. TEST MEMPERBARUI TUGAS (UPDATE)
     */
    public function test_it_can_update_a_task(): void
{
    $user = $this->createDummyUser();
    
    $task = Task::create([
        'user_id'     => $user->id,
        'title'       => 'Tugas Enkripsi Data',
        'description' => 'Kriptografi dasar',
        'deadline'    => now()->addDays(2)->format('Y-m-d H:i:s'),
        'status'      => 'pending'
    ]);

    $updateData = [
        'user_id'  => $user->id, // Tambahkan ini agar lebih aman
        'title'    => 'Tugas Enkripsi Data (Selesai)',
        'deadline' => $task->deadline->format('Y-m-d H:i:s'),
        'status'   => 'done'
    ];

    $updatedTask = $this->taskService->updateTask($task->id, $updateData);

    $this->assertEquals('Tugas Enkripsi Data (Selesai)', $updatedTask->title);
    $this->assertEquals('done', $updatedTask->status);
}

    /**
     * 4. TEST MENGHAPUS TUGAS (DESTROY)
     */
    public function test_it_can_delete_a_task(): void
{
    $user = $this->createDummyUser();
    
    // Pastikan data benar-benar tersimpan di DB testing
    $task = Task::create([
        'user_id' => $user->id,
        'title' => 'Tugas Yang Akan Dihapus',
        'deadline' => now()->addDays(1)->format('Y-m-d H:i:s'),
        'status' => 'pending'
    ]);

    // Jalankan fungsi hapus menggunakan ID asli tugas tersebut
    $this->taskService->deleteTask($task->id);

    // Buktikan bahwa datanya sudah hilang dari database
    $this->assertDatabaseMissing('tasks', [
        'id' => $task->id
    ]);
    }
}