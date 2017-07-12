<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Graphql\Controller;

use GraphQL\Schema;
use GraphQL\GraphQL;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
//use Zend\View\Model\ViewModel;

class GraphQLController extends AbstractActionController
{
    /**
     * @var Schema
     */
    protected $schema;

    /**
     * GraphQLController constructor.
     * @param Schema $schema
     */
    public function __construct(Schema $schema)
    {
        $this->schema = $schema;
    }
    
    public function indexAction()
    {
        $input = json_decode($this->params()->fromPost('input'),TRUE);
        $query = $input['query'];
        $variableValues = isset($input['variables']) ? $input['variables'] : null;
        $operationName = $this->params()->fromPost('operation');
        $rootValue = null;
        $context = null;

        try {
            $result = GraphQL::execute(
                $this->schema,
                $query,
                $rootValue,
                $context,
                $variableValues,
                $operationName
            );
        } catch (\Exception $exception) {
            $result = [
                'errors' => [
                    ['message' => $exception->getMessage()]
                ]
            ];
        }

        echo json_encode($result);exit;
//        return new JsonModel($result);
//        return new ViewModel();
    }
}
