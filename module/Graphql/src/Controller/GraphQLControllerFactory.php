<?php

namespace Graphql\Controller;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class GraphQLControllerFactory
 * @package Graphql\Controller
 */
class GraphQLControllerFactory implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return GraphQLController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $controller = new GraphQLController($container->get('Graphql\Schema'));

        return $controller;
    }

}

