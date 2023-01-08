<?php

declare(strict_types=1);

namespace MicroCRM\Frontend\Security\Controller;

use MicroCRM\Frontend\Security\Facade\SecurityFacadeInterface;
use MicroCRM\Shared\DTO\Security\AuthConfigurationTransfer;

readonly class AuthConfigurationController
{
    public function __construct(
        private SecurityFacadeInterface $securityFacade
    ) {
    }

    public function receiveConfiguration(): AuthConfigurationTransfer
    {
        return $this->securityFacade->getAuthConfiguration();
    }
}
