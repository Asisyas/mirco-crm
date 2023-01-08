<?php

declare(strict_types=1);

namespace MicroCRM\Frontend\Security\AuthConfig;

use MicroCRM\Shared\DTO\Security\AuthConfigurationTransfer;

interface AuthConfigurationFactoryInterface
{
    public function create(): AuthConfigurationTransfer;
}
