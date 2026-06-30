<?php

namespace App\Contracts;

interface TaskServiceInterface
{
    public function getAllTasks(array $filters = []);

    public function createTask(array $data);

    public function updateTask(int $id, array $data);

    public function deleteTask(int $id): bool;
}
