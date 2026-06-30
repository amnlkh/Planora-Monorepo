<?php

namespace App\Services;

use App\Contracts\ScheduleServiceInterface;
use Illuminate\Support\Facades\Auth;

class ScheduleService implements ScheduleServiceInterface
{
    public function getAllSchedules(array $filters = [])
    {
        return Auth::user()
            ->schedules()
            ->byMonthYear(
                $filters['month'] ?? null,
                $filters['year'] ?? null
            )
            ->orderBy('date', 'asc')
            ->orderBy('start_time', 'asc')
            ->get();
    }

    public function createSchedule(array $data)
    {
        return Auth::user()->schedules()->create([
            'title' => $data['title'],
            'date' => $data['date'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'note' => $data['note'] ?? null,
        ]);
    }

    public function deleteSchedule(int $id): bool
    {
        $schedule = Auth::user()->schedules()->findOrFail($id);

        return $schedule->delete();
    }
}