<?php

use App\Client\DatabaseClient;
use App\Client\DatabaseClientInterface;
use App\Controllers\TaskController;
use App\Repository\TaskRepository;
use App\Repository\TaskRepositoryInterface;
use Symfony\Component\Serializer\DependencyInjection\SerializerPass;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

// Define application dependencies
$container->register(DatabaseClient::class, DatabaseClient::class)->setAutowired(true);
$container->setAlias(DatabaseClientInterface::class, DatabaseClient::class);
$container->register(TaskRepository::class, TaskRepository::class)->setAutowired(true);
$container->setAlias(TaskRepositoryInterface::class, TaskRepository::class);
$container->register(Serializer::class, Serializer::class)
    ->setArguments([[new ObjectNormalizer()]]);
$container->setAlias(\Symfony\Component\Serializer\SerializerInterface::class, Serializer::class);
//->setArguments([[new ObjectNormalizer()]]);
//$container->register(ObjectNormalizer::class, ObjectNormalizer::class)->setAutowired(true);
//$container->register(ArrayDenormalizer::class, ArrayDenormalizer::class)->setAutowired(true);
//$container->register(DenormalizerInterface::class, Serializer::class)->setAutowired(true);

$container->register(TaskController::class, TaskController::class)->setAutowired(true)->setPublic(true);
