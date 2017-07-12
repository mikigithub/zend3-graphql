<?php
namespace Graphql\Query;

use Interop\Container\ContainerInterface;
use GraphQL\Type\Definition\Type;
use Zend\ServiceManager\Factory\FactoryInterface;
use Graphql\Type\TypeFactory;
/**
 * Description of UserFactory
 *
 * @author alex
 */
class ListarFactory implements FactoryInterface{
    
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $typeFactory = $this->getTypeFactory($container);

        $field = [
            'type' => $typeFactory->getType('Listar'), // The name of the object type
            'args' => [
                'id' => [
                    'name' => 'id',
                    'type' => Type::string(),
                    'description' => 'If omitted, it returns user by id',
                ],
                'name' => [
                    'name' => 'name',
                    'type' => Type::string(),
                    'description' => 'If omitted, it returns user by name',
                ],
                'email' => [
                    'name' => 'email',
                    'type' => Type::string(),
                    'description' => 'If omitted, it returns user by email',
                ],
            ],
            'resolve' => function() {
                return '5';
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
