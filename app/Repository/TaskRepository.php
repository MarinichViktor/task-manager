<?php


namespace App\Repository;


use App\Client\DatabaseClientInterface;
use App\Entity\Task;
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

    public function listTasks(): array
    {
        $results = $this->client->query("SELECT * FROM tasks");
        return array_map(fn($object) => $this->serializer->denormalize($object, Task::class), $results);
    }

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
