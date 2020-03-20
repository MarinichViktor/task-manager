<?php


namespace App\Repository;


use App\Entity\Task;

interface TaskRepositoryInterface
{
    public function listTasks(): array;
    public function save(Task $task): void;
}
