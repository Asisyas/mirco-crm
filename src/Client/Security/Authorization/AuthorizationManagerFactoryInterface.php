<?php

declare(strict_types=1);

namespace MicroCRM\Client\Security\Authorization;

interface AuthorizationManagerFactoryInterface
{
    public function create(): AuthorizationManagerInterface;
}
