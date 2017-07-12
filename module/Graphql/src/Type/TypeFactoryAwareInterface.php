<?php

namespace Graphql\Type;

/**
 * Interface TypeFactoryAwareInterface
 * @package Graphql\Type
 */
interface TypeFactoryAwareInterface
{

    /**
     * @param TypeFactory $typeFactory
     * @return mixed
     */
    public function setTypeFactory(TypeFactory $typeFactory);

    /**
     * @return TypeFactory
     */
    public function getTypeFactory() : TypeFactory;

}