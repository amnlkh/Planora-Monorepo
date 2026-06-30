<?php

namespace App\Contracts;

interface ScheduleServiceInterface
{
    public function getAllSchedules(array $filters = []);

    public function createSchedule(array $data);

    public function deleteSchedule(int $id): bool;
}
