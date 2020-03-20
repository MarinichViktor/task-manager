<?php


namespace App\Client;


use App\Exception\DatabaseException;

interface DatabaseClientInterface
{
    /**
     * @param string $sqlQuery
     * @param array $parameters
     *
     * @throws DatabaseException
     */
    public function execute(string  $sqlQuery, array $parameters = []): void;
}
