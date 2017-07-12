<?php
namespace Graphql\Query;

use Interop\Container\ContainerInterface;
use GraphQL\Type\Definition\Type;
use Zend\ServiceManager\Factory\FactoryInterface;
use Graphql\Type\TypeFactory;
use Graphql\Entity\Package;
use Graphql\Data\DataSource;
/**
 * Description of UserFactory
 *
 * @author alex
 */
class PackageDetailFactory implements FactoryInterface{
    
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $typeFactory = $this->getTypeFactory($container);

        $field = [
            'type' => Type::listOf($typeFactory->getType('PackageDetail')), // The name of the object type
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
					$packageDetails = DataSource::getPackageDetails();
				}
				
                if(!is_null($args['id'])) {
                    $packageDetails = DataSource::findPackageDetailWhereIn($args['id']);
					foreach ($packageDetails as $key => $packageDetail) {
						$packageDetails[$key]->package = DataSource::findPackage($packageDetail->idPqAgente);
					  
					}
                }
                
                return $packageDetails;
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
