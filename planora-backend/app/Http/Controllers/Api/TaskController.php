<?php

namespace App\Http\Controllers\Api;

use App\Contracts\TaskServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected TaskServiceInterface $taskService;

    public function __construct(TaskServiceInterface $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index(Request $request)
    {
        // 1. Ambil user dari middleware kustom Anda
        $user = $request->attributes->get('authenticated_user');

        // 2. Teruskan user_id ke service layer agar filter datanya tepat
        $filters = $request->only(['status', 'sort']);
        $filters['user_id'] = $user->id; 

        $tasks = $this->taskService->getAllTasks($filters);

        // 3. Tambahkan summary metadata statistik untuk kebutuhan kotak angka di Dashboard React
        $totalTasks = $tasks->count();
        $completedTasks = $tasks->where('status', 'done')->count(); // Sesuai konstanta model Anda
        $pendingTasks = $tasks->where('status', 'pending')->count();

        return response()->json([
            'status' => 'success',
            'data' => [
                'tasks' => $tasks,
                'stats' => [
                    'total' => $totalTasks,
                    'completed' => $completedTasks,
                    'pending' => $pendingTasks,
                ]
            ],
        ]);
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:150',
        'deadline' => 'required|date',
    ]);

    // Lanjutkan ke service setelah tervalidasi
    return $this->taskService->createTask($validated);
}
    public function update(Request $request, int $id)
    {
        // Opsional: Validasi kepemilikan bisa ditaruh di sini atau di dalam Service Layer
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'deadline' => ['required', 'date'],
            'status' => ['required', 'in:pending,done'],
        ]);

        $task = $this->taskService->updateTask($id, $validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Tugas berhasil diperbarui',
            'data' => $task,
        ]);
    }

    public function destroy(int $id)
    {
        $this->taskService->deleteTask($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Tugas berhasil dihapus',
        ]);
    }
}