<?php
namespace Graphql\ObjectType;

use GraphQL\Type\Definition\ObjectType;
use Interop\Container\ContainerInterface;
use GraphQL\Type\Definition\Type;
use Zend\ServiceManager\Factory\FactoryInterface;
use Graphql\Type\TypeFactory;

/**
 * Description of UserFactory
 *
 * @author alex
 */
class ListarType extends ObjectType {
    
    public function __construct(TypeFactory $typeFactory) {
        parent::__construct([
            'name' => 'Prueba',
            'description' => 'A user on my website',
            'fields' => [
                'id' => [
                    'type' => Type::string(),
                    'description' => 'Id of the user',
                ],
                'name' => [
                    'type' => Type::string(),
                    'description' => 'Nombre de la descripcion',
                ],
                'apellido' => [
                    'type' => Type::string(),
                    'description' => 'Email of the user',
                ],
                
            ]
        ]);
    }
}
