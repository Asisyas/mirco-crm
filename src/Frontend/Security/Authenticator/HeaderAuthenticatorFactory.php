<?php

declare(strict_types=1);

namespace MicroCRM\Frontend\Security\Authenticator;

use MicroCRM\Client\Security\Client\SecurityClientInterface;
use MicroCRM\Frontend\Security\Configuration\SecurityPluginConfigurationInterface;
use MicroCRM\Frontend\Security\Token\Factory\AuthTokenFactoryInterface;

readonly class HeaderAuthenticatorFactory implements AuthenticatorFactoryInterface
{
    public function __construct(
        private SecurityClientInterface $securityClient,
        private AuthTokenFactoryInterface $authTokenFactory,
        private SecurityPluginConfigurationInterface $pluginConfiguration
    ) {
    }

    public function create(): AuthenticatorInterface
    {
        return new HeaderAuthenticator(
            $this->securityClient,
            $this->authTokenFactory,
            $this->pluginConfiguration
        );
    }
}
