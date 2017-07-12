<?php

namespace Graphql\Resolver;

use Graphql\Type\Definition\ResolveInfo;

/**
 * Interface ResolverInterface
 * @package Graphql\Resolver
 */
interface ResolverInterface
{

    /**
     * @param $object
     * @param array $args
     * @param $context
     * @param ResolveInfo $info
     * @return mixed
     */
    public function __invoke($object, array $args, $context, ResolveInfo $info);

}