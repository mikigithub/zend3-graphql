<?php
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
