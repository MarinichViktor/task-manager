<?php


namespace App\Repository;


use App\Client\DatabaseClientInterface;
use App\Entity\Task;
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
    public function save(Task $task): void
    {
        $sql = "INSERT INTO tasks(name, email, description, completed) VALUES (:name, :email, :description, :completed)";
        $this->client->execute($sql, [
            ':name' => $task->name,
            ':email' => $task->email,
            ':description' => $task->description,
            ':completed' => $task->completed,
        ]);
    }

    private function ensureCreated(): void
    {
        $this->client->execute("
            CREATE TABLE IF NOT EXISTS tasks (
              id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
              name varchar(255) NOT NULL,
              email varchar(255) NOT NULL,
              description TEXT NOT NULL,
              completed INTEGER NOT NULL
            )
        ");
    }
}
