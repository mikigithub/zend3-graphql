<?php
namespace Graphql\Entity;

use GraphQL\Utils;

class Listar
{
    public $id;

    public $name;
	
    public $apellido;

    public function __construct(array $data)
    {
        Utils::assign($this, $data);
    }
}
