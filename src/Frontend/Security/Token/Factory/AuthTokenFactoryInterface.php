<?php

namespace MicroCRM\Frontend\Security\Token\Factory;

use MicroCRM\Frontend\Security\Token\Model\AuthTokenInterface;
use MicroCRM\Shared\DTO\Security\TokenTransfer;

interface AuthTokenFactoryInterface
{
    public function create(TokenTransfer $token): AuthTokenInterface;
}
