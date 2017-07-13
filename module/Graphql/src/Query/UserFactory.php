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
                /*'name' => [
                    'name' => 'name',
                    'type' => Type::string(),
                    'description' => 'If omitted, it returns user by name',
                ],
                'email' => [
                    'name' => 'email',
                    'type' => Type::string(),
                    'description' => 'If omitted, it returns user by email',
                ],*/
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
