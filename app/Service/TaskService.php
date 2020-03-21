<?php


namespace App\Service;


use App\Entity\Task;
use App\Model\PaginationQuery;
use App\Model\PaginationResponse;
use App\Model\TaskData;
use App\Repository\TaskRepositoryInterface;

class TaskService implements TaskServiceInterface
{
    private TaskRepositoryInterface $repository;
    private AuthenticationServiceInterface $authenticationService;

    public function __construct(
        TaskRepositoryInterface $repository,
        AuthenticationServiceInterface $authenticationService
    ) {
        $this->repository = $repository;
        $this->authenticationService = $authenticationService;
    }

    /**
     * @inheritDoc
     */
    public function listTasks(PaginationQuery $query): PaginationResponse
    {
        return $this->repository->listTasks($query);
    }

    /**
     * @param int $id
     */
    public function markAsEditedByAdmin(int $id): void
    {
        $task = $this->repository->find($id);
        $task->editedByAdmin = 1;

        $this->repository->create($task);
    }

    /**
     * @inheritDoc
     */
    public function find(int $id): Task
    {
        return $this->repository->find($id);
    }

    /**
     * @inheritDoc
     */
    public function create(TaskData $data): void
    {
        $task = new Task();
        $task->name = $data->name;
        $task->email = $data->email;
        $task->description = $data->description;
        $task->completed = $data->completed;

        $this->repository->create($task);
    }

    public function update(int $id, TaskData $data): void
    {
        $task = $this->repository->find($id);
        $markAsEditedByAdmin = $task->description !== $data->description;
        $task->name = $data->name;
        $task->email = $data->email;
        $task->description = $data->email;
        $task->completed = $data->completed;

        if ($markAsEditedByAdmin && null !== $this->authenticationService->currentUser()) {
            $task->editedByAdmin = 1;
        }

        $this->repository->update($task);
    }
}
