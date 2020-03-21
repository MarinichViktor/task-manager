<?php

use Framework\Renderer\RenderEngineInterface;
use Framework\Renderer\TwigEngine;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\HttpKernel;
use Framework\Resolver\ControllerResolver;
use Symfony\Component\Serializer\DependencyInjection\SerializerPass;

$container = new ContainerBuilder();
$container->addCompilerPass(new SerializerPass());

$container->register('controllerResolver', ControllerResolver::class)
    ->addMethodCall('setContainer', [$container]);
$container->register('argumentResolver', ArgumentResolver::class);
$container->register('dispatcher', EventDispatcher::class);
$container->register('requestStack', RequestStack::class);
$container->register('app', HttpKernel::class)
    ->setArguments([
        new Reference('dispatcher'),
        new Reference('controllerResolver'),
        new Reference('requestStack'),
        new Reference('argumentResolver'),
    ])
    ->setPublic(true);
$environment = new Twig\Environment(new Twig\Loader\FilesystemLoader('./app/Views'), []);
$environment->addGlobal("currentUser", ["name" => "john"]);
$container->register(TwigEngine::class, TwigEngine::class)
    ->setArguments([$environment])
    ->setPublic(true)
    ->setAutowired(true);

$container->setAlias(RenderEngineInterface::class, TwigEngine::class)->setPublic(true);

