<?php

namespace Framework\Resolver;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use \Symfony\Component\HttpKernel\Controller\ControllerResolver as  BaseControllerResolver;

class ControllerResolver extends BaseControllerResolver
{
    private ContainerBuilder $container;

    /**
     * @param ContainerBuilder $container
     */
    public function setContainer(ContainerBuilder $container): void
    {
         $this->container = $container;
    }

    /**
     * @inheritDoc
     *
     * @param string $class
     *
     * @return object
     */
    protected function instantiateController(string $class)
    {
        if( null !== ($controller = $this->container->get($class))) {
            return $controller;
        }

        return parent::instantiateController($class);
    }
}
