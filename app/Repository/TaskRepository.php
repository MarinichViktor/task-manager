<?php


namespace App\Repository;


use App\Client\DatabaseClientInterface;
use App\Entity\Task;
use App\Exception\TaskNotFoundException;
use App\Model\PaginationQuery;
use App\Model\PaginationResponse;
use Symfony\Component\Serializer\SerializerInterface;

class TaskRepository implements TaskRepositoryInterface
{
    private DatabaseClientInterface $client;
    private SerializerInterface $serializer;

    public function __construct(DatabaseClientInterface $client, SerializerInterface $serializer)
    {
        $this->client = $client;
        $this->ensureCreated();
        $this->serializer = $serializer;
    }

    /**
     * @inheritDoc
     */
    public function listTasks(PaginationQuery $query): PaginationResponse
    {
        $count = (int) $this->client->query("SELECT COUNT(*) as count FROM tasks")[0]['count'];
        $results = $this->client->query("SELECT * FROM tasks LIMIT :limit OFFSET :offset", [
            ':limit' => $query->limit,
            ':offset' => $query->offset,
        ]);
        $tasks = array_map(fn($object) => $this->serializer->denormalize($object, Task::class), $results);

        return new PaginationResponse($count, $tasks, $query->page, $query->limit);
    }

    /**
     * @inheritDoc
     */
    public function find(int $id): Task
    {
        $results = $this->client->query("SELECT * FROM tasks WHERE tasks.id = :id LIMIT 1", [
            ':id' => $id,
        ]);

        if (!count($results)) {
            throw new TaskNotFoundException();
        }

        return $this->serializer->denormalize($results[0], Task::class);
    }

    /**
     * @inheritDoc
     */
    public function create(Task $task): void
    {
        $sql = "INSERT INTO tasks(name, email, description, completed, editedByAdmin) VALUES (:name, :email, :description, :completed, :editedByAdmin)";
        $this->client->execute($sql, [
            ':name' => $task->name,
            ':email' => $task->email,
            ':description' => $task->description,
            ':completed' => $task->completed,
            ':editedByAdmin' => $task->editedByAdmin,
        ]);
    }

    public function update(Task $task): void
    {
        $sql = "UPDATE tasks SET name = :name, email = :email, description = :description, completed = :completed, editedByAdmin = :editedByAdmin WHERE tasks.id = :id";
        $this->client->execute($sql, [
            ':name' => $task->name,
            ':email' => $task->email,
            ':description' => $task->description,
            ':completed' => $task->completed,
            ':editedByAdmin' => $task->editedByAdmin,
            ':id' => $task->id,
        ]);
    }

    private function ensureCreated(): void
    {
        $this->client->execute("
            CREATE TABLE IF NOT EXISTS tasks (
              id INTEGER PRIMARY KEY NOT NULL,
              name varchar(255) NOT NULL,
              email varchar(255) NOT NULL,
              description TEXT NOT NULL,
              completed INTEGER NOT NULL,
              editedByAdmin INTEGER NOT NULL DEFAULT 0
            )
        ");
    }
}
