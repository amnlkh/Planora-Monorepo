<?php

namespace Tests\Feature;

use App\Contracts\AuthServiceInterface;
use App\Contracts\DashboardServiceInterface;
use App\Contracts\HolidayServiceInterface;
use App\Contracts\ScheduleServiceInterface;
use App\Contracts\TaskServiceInterface;
use Tests\TestCase;

class ServiceBindingTest extends TestCase
{
    public function test_all_service_interfaces_are_bound(): void
    {
        $interfaces = [
            AuthServiceInterface::class,
            DashboardServiceInterface::class,
            HolidayServiceInterface::class,
            ScheduleServiceInterface::class,
            TaskServiceInterface::class,
        ];

        foreach ($interfaces as $interface) {
            $service = app($interface);

            $this->assertInstanceOf(
                $interface,
                $service,
                "{$interface} belum terhubung dengan implementasi service."
            );
        }
    }
}