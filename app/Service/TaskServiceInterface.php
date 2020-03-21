<?php


namespace App\Service;


use App\Entity\Task;
use App\Model\PaginationQuery;
use App\Model\PaginationResponse;
use App\Model\TaskData;

interface TaskServiceInterface
{
    /**
     * @param PaginationQuery $query
     *
     * @return PaginationResponse
     */
    public function listTasks(PaginationQuery $query): PaginationResponse;

    /**
     * @param int $id
     *
     * @return Task
     */
    public function find(int $id): Task;

    /**
     * @param int $id
     */
    public function markAsEditedByAdmin(int $id): void;

    /**
     * @param TaskData $data
     */
    public function create(TaskData $data): void;

    /**
     * @param int $id
     *
     * @param TaskData $data
     */
    public function update(int $id, TaskData $data): void;
}
