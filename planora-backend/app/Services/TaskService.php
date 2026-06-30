<?php

namespace App\Services;

use App\Contracts\TaskServiceInterface;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskService implements TaskServiceInterface
{
    // 1. MENGAMBIL SEMUA TUGAS
    public function getAllTasks(array $filters = [])
    {
        // Ambil user_id dari array filter (jika dikirim dari test/controller) atau dari Auth bawaan
        $userId = $filters['user_id'] ?? Auth::id();

        $query = Task::where('user_id', $userId);

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query->get();
    }

    // 2. MEMBUAT TUGAS BARU
    public function createTask(array $data)
    {
        // Pastikan user_id selalu terisi
        $data['user_id'] = $data['user_id'] ?? Auth::id();

        return Task::create($data);
    }

    // 3. MEMPERBARUI TUGAS (Sesuai Line 44 di error gambar Anda)
    public function updateTask(int $id, array $data)
    {
        // Cari tugas secara global berdasarkan ID-nya terlebih dahulu
        $task = Task::findOrFail($id);

        // Lakukan pembaruan data
        $task->update([
            'title'       => $data['title'],
            'description' => $data['description'] ?? null,
            'deadline'    => $data['deadline'],
            'status'      => $data['status'],
        ]);

        return $task;
    }

    // 4. MENGHAPUS TUGAS (Sudah Lolos)
    public function deleteTask(int $id): bool
    {
        $task = Task::find($id);

        if (!$task) {
            return false; 
        }

        return (bool) $task->delete();
    }
}