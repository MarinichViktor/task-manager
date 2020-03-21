<?php

use App\Client\DatabaseClient;
use App\Client\DatabaseClientInterface;
use App\Controllers\TaskController;
use App\Repository\InMemoryUserRepository;
use App\Repository\TaskRepository;
use App\Repository\TaskRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Symfony\Component\Serializer\DependencyInjection\SerializerPass;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

// Define application dependencies
$container->register(DatabaseClient::class, DatabaseClient::class)->setAutowired(true);
$container->setAlias(DatabaseClientInterface::class, DatabaseClient::class);
$container->register(TaskRepository::class, TaskRepository::class)->setAutowired(true);
$container->setAlias(TaskRepositoryInterface::class, TaskRepository::class);
$container->register(Serializer::class, Serializer::class)->setArguments([[new ObjectNormalizer()]]);
$container->setAlias(SerializerInterface::class, Serializer::class);
$container->register(TaskController::class, TaskController::class)->setAutowired(true)->setPublic(true);
$container->register(InMemoryUserRepository::class, InMemoryUserRepository::class)->setAutowired(true)->setPublic(true);
$container->setAlias(UserRepositoryInterface::class, InMemoryUserRepository::class);
