<?php

declare(strict_types=1);

namespace MicroCRM\Frontend\Security\AuthConfig;

use MicroCRM\Frontend\Security\AuthConfig\Expander\AuthConfigTransferExpanderFactoryInterface;
use MicroCRM\Shared\DTO\Security\AuthConfigurationTransfer;

readonly class AuthConfigurationFactory implements AuthConfigurationFactoryInterface
{
    public function __construct(
        private AuthConfigTransferExpanderFactoryInterface $authConfigTransferExpanderFactory
    ) {
    }

    public function create(): AuthConfigurationTransfer
    {
        $authConfigurationTransfer = new AuthConfigurationTransfer();

        $this->authConfigTransferExpanderFactory
            ->create()
            ->expand($authConfigurationTransfer);

        return $authConfigurationTransfer;
    }
}
