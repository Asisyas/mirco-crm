<?php

declare(strict_types=1);

namespace MicroCRM\Frontend\Security\AuthConfig\Expander\Impl;

use MicroCRM\Frontend\Security\AuthConfig\Expander\AuthConfigTransferExpanderInterface;
use MicroCRM\Shared\DTO\Security\AuthConfigurationTransfer;
use Micro\Plugin\OAuth2\Client\Facade\Oauth2ClientFacadeInterface;

readonly class OAuth2Expander implements AuthConfigTransferExpanderInterface
{
    public function __construct(
        private Oauth2ClientFacadeInterface $oauth2ClientFacade
    ) {
    }

    public function expand(AuthConfigurationTransfer $authConfigurationTransfer): void
    {
        $provider = $this->oauth2ClientFacade->getProvider('default');

        $authConfigurationTransfer->setUrlAuth($provider->getAuthorizationUrl());
    }
}
