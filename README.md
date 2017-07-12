# Zend3Graphql
@author: Alex Was

## Introduction

This is a GranphQL in a skeleton application using the Zend Framework MVC layer and module
systems.

## Requirements

- docker engine (version used: 17.03.0-ce)
- docker-compose (version used: 1.11.1)

You have to do composer update for getting all libraries. It's necesary verified that you have:
- graphql-php

Used the willzyc's module.

## Running

```bash
$ docker-compose up
```

## Command used

Go:
```bash
 http://localhost:8000/zendgraphql
```

Example code line on textArea:

```bash
 {"query": "query { packageDetail(id: 1){id package{id}}  }"}
```

Click on button Send

Response is:

```bash
 {"data":{"packageDetail":[{"id":"11202","package":{"id":"6"}}]}}
```
## Implement code

## Create new Object (User)

1. Create class User on:

```bash
namespace Graphql\Entity;

use GraphQL\Utils;

class User
{
    public $id;

    public $email;
	
    public $firstName;

    public $lastName;

    public function __construct(array $data)
    {
        Utils::assign($this, $data);
    }
}
```

2. Create ObjectType Use

```bash
namespace Graphql\ObjectType;

use GraphQL\Type\Definition\ObjectType;
use Graphql\Type\TypeFactory;
use GraphQL\Type\Definition\Type;

/**
 * Description of User
 *
 * @author alex
 */
class User extends ObjectType {
    
    public function __construct(TypeFactory $typeFactory) {
        parent::__construct([
            'name' => 'User',
            'description' => 'A user on my website',
            'fields' => [
                'id' => [
                    'type' => Type::string(),
                    'description' => 'Id of the user'
                ],
                'firstName' => [
                    'type' => Type::string(),
                    'description' => 'First Name of the user',
                ],
                'lastName' => [
                    'type' => Type::string(),
                    'description' => 'Last Name of the user',
                ],
                'email' => [
                    'type' => Type::string(),
                    'description' => 'Email of the user',
                ],
            ]
        ]);
    }
}
```

3. Create UserFactory

```bash
<?php
namespace Graphql\Query;

use Interop\Container\ContainerInterface;
use GraphQL\Type\Definition\Type;
use Zend\ServiceManager\Factory\FactoryInterface;
use Graphql\Type\TypeFactory;
use Graphql\Entity\User;
use Graphql\Data\DataSource;
/**
 * Description of UserFactory
 *
 * @author alex
 */
class UserFactory implements FactoryInterface{
    
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $typeFactory = $this->getTypeFactory($container);

        $field = [
            'type' => Type::listOf($typeFactory->getType('User')), // The name of the object type
            'args' => [
                'id' => [
                    'name' => 'id',
                    'type' => Type::listOf(Type::int()),
                    'description' => 'If omitted, it returns user by id',
                ],
            ],
            'resolve' => function($root, $args) {
                DataSource::init();
			if(is_null($args['id'])) {
			  $user = DataSource::getUsers();
			}
				
                if(!is_null($args['id'])) {
			  $user = DataSource::findUserWhereIn($args['id']);
                }
                return $user;
            }
        ];

        return $field;
    }

    /**
     * @param ContainerInterface $container
     * @return TypeFactory
     */
    public function getTypeFactory(ContainerInterface $container)
    {
        $typeFactory = $container->get('Graphql\TypeFactory');

        return $typeFactory;
    }

}

```

4. Configured on module.config

```bash
'service_manager' => [
        'invokables' => [
            'Graphql\ObjectType\UserType' => 'Graphql\ObjectType\UserType',
        ],
        'factories' => [
            'Graphql\Query\User' => 'Graphql\Query\UserFactory',
        ],
	.
	.
	.
    ],
'graphql' => [
        'query' => [
            'fields' => [
                'user' => [
                    'service' => 'Graphql\Query\User',
                ],
            ],
        ],
        'mutation' => [
            'fields' => [
                
            ],
        ],
        'types' => [
            'User' => 'Graphql\ObjectType\UserType',
        ],
    ],
```


