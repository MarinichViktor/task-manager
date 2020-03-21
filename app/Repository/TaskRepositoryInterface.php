<?php


namespace App\Repository;


use App\Entity\Task;
use App\Model\PaginationQuery;
use App\Model\PaginationResponse;

interface TaskRepositoryInterface
{
    /**
     * @param PaginationQuery $query
     *
     * @return PaginationResponse
     */
    public function listTasks(PaginationQuery $query): PaginationResponse;

    /**
     * @param Task $task
     */
    public function save(Task $task): void;
}
