<?php

declare(strict_types=1);

namespace MicroCRM\Frontend\Security\Authenticator;

interface AuthenticatorFactoryInterface
{
    public function create(): AuthenticatorInterface;
}
