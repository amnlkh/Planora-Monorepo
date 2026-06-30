<?php

namespace App\Http\Controllers\Api;

use App\Contracts\ScheduleServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    protected ScheduleServiceInterface $scheduleService;

    public function __construct(ScheduleServiceInterface $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }

    public function index(Request $request)
    {
        $schedules = $this->scheduleService->getAllSchedules(
            $request->only(['month', 'year'])
        );

        return response()->json([
            'status' => 'success',
            'data' => $schedules,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'date' => ['required', 'date_format:Y-m-d'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'note' => ['nullable', 'string'],
        ]);

        $schedule = $this->scheduleService->createSchedule($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Jadwal belajar berhasil ditambahkan',
            'data' => $schedule,
        ], 201);
    }

    public function destroy(int $id)
    {
        $this->scheduleService->deleteSchedule($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Jadwal belajar berhasil dihapus',
        ]);
    }
}