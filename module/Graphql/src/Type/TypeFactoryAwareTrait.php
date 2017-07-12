<?php

namespace Graphql\Type;

/**
 * Class TypeFactoryAwareTrait
 * @package Graphql\Type
 */
trait TypeFactoryAwareTrait
{

    /**
     * @var TypeFactory
     */
    protected $typeFactory;

    /**
     * @param TypeFactory $typeFactory
     * @return $this
     */
    public function setTypeFactory(TypeFactory $typeFactory)
    {
        $this->typeFactory = $typeFactory;
        return $this;
    }

    /**
     * @return TypeFactory
     */
    public function getTypeFactory() : TypeFactory
    {
        return $this->typeFactory;
    }

}