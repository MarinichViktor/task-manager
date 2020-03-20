<?php

namespace App\Client;


use App\Exception\DatabaseException;
use PDO;

class DatabaseClient implements DatabaseClientInterface
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('sqlite:db/database.db');
    }

    /**
     * @inheritDoc
     */
    public function query(string $sqlQuery, int $mode = PDO::FETCH_ASSOC): array
    {
        $statement = $this->pdo->query("");
        $results = [];

        while ($row = $statement->fetch($mode)) {
            $results[] = $row;
        }

        return $results;
    }

    /**
     * @inheritDoc
     */
    public function execute(string  $sqlQuery, array $parameters = []): void
    {
        $statement = $this->pdo->prepare($sqlQuery);

        foreach ($parameters as $key => $value) {
            $statement->bindParam($key, $value);
        }

        if (!$statement->execute()) {
            throw new DatabaseException("DatabaseException: Failed to execute: {$sqlQuery}");
        }
    }
}
