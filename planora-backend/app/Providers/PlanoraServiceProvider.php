<?php

namespace App\Providers;

use App\Contracts\AuthServiceInterface;
use App\Services\AuthService;
use App\Contracts\DashboardServiceInterface;
use App\Contracts\HolidayServiceInterface;
use App\Contracts\ScheduleServiceInterface;
use App\Contracts\TaskServiceInterface;
use App\Services\DashboardService;
use App\Services\HolidayService;
use App\Services\ScheduleService;
use App\Services\TaskService;
use Illuminate\Support\ServiceProvider;

class PlanoraServiceProvider extends ServiceProvider
{
    public function register(): void

    {
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        
        $this->app->bind(TaskServiceInterface::class, TaskService::class);

        $this->app->bind(ScheduleServiceInterface::class, ScheduleService::class);

        $this->app->bind(DashboardServiceInterface::class, DashboardService::class);

        $this->app->bind(HolidayServiceInterface::class, HolidayService::class);
    }

    public function boot(): void
    {
        //
    }
}