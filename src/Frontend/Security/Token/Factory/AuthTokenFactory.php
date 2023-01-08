<?php

namespace MicroCRM\Frontend\Security\Token\Factory;

use MicroCRM\Frontend\Security\Token\Model\AuthToken;
use MicroCRM\Frontend\Security\Token\Model\AuthTokenInterface;
use MicroCRM\Shared\DTO\Security\TokenTransfer;

class AuthTokenFactory implements AuthTokenFactoryInterface
{
    public function create(TokenTransfer $token): AuthTokenInterface
    {
        return new AuthToken($token);
    }
}
