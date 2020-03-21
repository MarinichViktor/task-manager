<?php

use App\Client\AuthenticationClient;
use App\Client\AuthenticationClientInterface;
use App\Client\DatabaseClient;
use App\Client\DatabaseClientInterface;
use App\Controllers\AuthenticationController;
use App\Controllers\TaskController;
use App\Repository\InMemoryUserRepository;
use App\Repository\TaskRepository;
use App\Repository\TaskRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use App\Service\AuthenticationService;
use App\Service\AuthenticationServiceInterface;
use App\Service\TaskService;
use App\Service\TaskServiceInterface;
use App\Validator\AuthenticationValidator;
use App\Validator\TaskValidator;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

// Define application dependencies
$container->register(DatabaseClient::class, DatabaseClient::class)->setAutowired(true);
$container->setAlias(DatabaseClientInterface::class, DatabaseClient::class);
$container->register(Serializer::class, Serializer::class)->setArguments([[new ObjectNormalizer()]]);
$container->setAlias(SerializerInterface::class, Serializer::class);

// TASK
$container->register(TaskRepository::class, TaskRepository::class)->setAutowired(true);
$container->setAlias(TaskRepositoryInterface::class, TaskRepository::class);
$container->register(TaskService::class, TaskService::class)->setAutowired(true);
$container->setAlias(TaskServiceInterface::class, TaskService::class);
$container->register(TaskValidator::class, TaskValidator::class)->setAutowired(true);
$container->register(TaskController::class, TaskController::class)->setAutowired(true)->setPublic(true);

// USER
$container->register(InMemoryUserRepository::class, InMemoryUserRepository::class)->setAutowired(true)->setPublic(true);
$container->setAlias(UserRepositoryInterface::class, InMemoryUserRepository::class);

// AUTH
$container->register(AuthenticationClient::class, AuthenticationClient::class)->setAutowired(true)->setPublic(true);
$container->setAlias(AuthenticationClientInterface::class, AuthenticationClient::class);
$container->register(AuthenticationValidator::class, AuthenticationValidator::class)->setAutowired(true)->setPublic(true);
$container->register(AuthenticationService::class, AuthenticationService::class)->setAutowired(true)->setPublic(true);
$container->setAlias(AuthenticationServiceInterface::class, AuthenticationService::class);

$container->register(AuthenticationController::class, AuthenticationController::class)->setAutowired(true)->setPublic(true);
