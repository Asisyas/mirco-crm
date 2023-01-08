<?php

namespace MicroCRM\Frontend\Security\Token\Storage;

use MicroCRM\Frontend\Security\Token\Model\AuthTokenInterface;

class TokenStorageFactory implements TokenStorageFactoryInterface
{
    public function create(AuthTokenInterface $authToken): TokenStorageInterface
    {
        return new TokenStorage($authToken);
    }
}
