<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Graphql;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'graphql' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/zendgraphql[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'zendgraphql' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/graphql',
                    'defaults' => [
                        'controller' => 'Graphql\Controller\GraphQL',
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            'Graphql\Controller\GraphQL' => 'Graphql\Controller\GraphQLControllerFactory',
            Controller\GraphQLController::class => InvokableFactory::class,
        ],
    ],
    'service_manager' => [
        'invokables' => [
            'Graphql\ObjectType\UserType' => 'Graphql\ObjectType\UserType',
            'Graphql\ObjectType\PackageType' => 'Graphql\ObjectType\PackageType',
            'Graphql\ObjectType\PackageDetailType' => 'Graphql\ObjectType\PackageDetailType',
            'Graphql\ObjectType\ListarType' => 'Graphql\ObjectType\ListarType',
            'Graphql\ObjectType\Registertype' => 'Graphql\ObjectType\Registertype',
        ],
        'factories' => [
            'Graphql\Query\User' => 'Graphql\Query\UserFactory',
            'Graphql\Query\Package' => 'Graphql\Query\PackageFactory',
            'Graphql\Query\PackageDetail' => 'Graphql\Query\PackageDetailFactory',
            'Graphql\Query\Listar' => 'Graphql\Query\ListarFactory',
            'Graphql\Mutation\Register' => 'Graphql\Mutation\RegisterFactory',
            'Graphql\Schema' => 'Graphql\Schema\SchemaFactory',
            'Graphql\Schema\Query' => 'Graphql\Schema\QueryFactory',
            'Graphql\Schema\Mutation' => 'Graphql\Schema\MutationFactory',
            'Graphql\TypeFactory' => 'Graphql\Type\TypeFactory',
        ],
        'initializers' => [
            'Graphql\Type\TypeFactoryInitializer',
        ],
        'shared' => [
            'Graphql\TypeFactory' => true,
        ],
    ],
    'graphql' => [
        'query' => [
            'fields' => [
                'listar' => [
                    'service' => 'Graphql\Query\Listar',
                ],
                'user' => [
                    'service' => 'Graphql\Query\User',
                ],
                'package' => [
                    'service' => 'Graphql\Query\Package',
                ],
                'packageDetail' => [
                    'service' => 'Graphql\Query\PackageDetail',
                ],
            ],
        ],
        'mutation' => [
            'fields' => [
                'user' => [
                    'service' => 'Graphql\Mutation\Register',
                ],
            ],
        ],
        'types' => [
            'User' => 'Graphql\ObjectType\UserType',
            'Package' => 'Graphql\ObjectType\PackageType',
            'PackageDetail' => 'Graphql\ObjectType\PackageDetailType',
            'Listar' => 'Graphql\ObjectType\ListarType',
            'Register' => 'Graphql\ObjectType\Registertype',
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'graphql/index/index' => __DIR__ . '/../view/graphql/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
