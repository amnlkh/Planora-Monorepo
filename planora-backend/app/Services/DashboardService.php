<?php

namespace App\Services;

use App\Contracts\DashboardServiceInterface;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class DashboardService implements DashboardServiceInterface
{
    public function getSummary(): array
    {
        $user = Auth::user();

        $totalTasks = $user->tasks()->count();

        $pendingTasks = $user->tasks()
            ->where('status', Task::STATUS_PENDING)
            ->count();

        $completedTasks = $user->tasks()
            ->where('status', Task::STATUS_DONE)
            ->count();

        $nearestDeadline = $user->tasks()
            ->where('status', Task::STATUS_PENDING)
            ->where('deadline', '>=', now())
            ->orderBy('deadline', 'asc')
            ->first();

        return [
            'total_tasks' => $totalTasks,
            'pending_tasks' => $pendingTasks,
            'completed_tasks' => $completedTasks,
            'nearest_deadline' => $nearestDeadline ? [
                'id' => $nearestDeadline->id,
                'title' => $nearestDeadline->title,
                'deadline' => $nearestDeadline->deadline,
            ] : null,
        ];
    }
}