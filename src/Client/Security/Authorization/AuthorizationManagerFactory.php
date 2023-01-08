<?php

declare(strict_types=1);

namespace MicroCRM\Client\Security\Authorization;

use Micro\Plugin\OAuth2\Client\Facade\Oauth2ClientFacadeInterface;
use Micro\Plugin\Security\Facade\SecurityFacadeInterface;
use MicroCRM\Client\Security\Authorization\Expander\SecurityTokenDataExpanderFactoryInterface;
use MicroCRM\Client\Security\Authorization\Expander\TokenTransferExpanderFactoryInterface;

class AuthorizationManagerFactory implements AuthorizationManagerFactoryInterface
{
    public function __construct(
        private readonly Oauth2ClientFacadeInterface $oauth2ClientFacade,
        private readonly SecurityFacadeInterface $securityFacade,
        private readonly SecurityTokenDataExpanderFactoryInterface $securityTokenDataExpanderFactory,
        private readonly TokenTransferExpanderFactoryInterface $tokenTransferExpanderFactory
    ) {
    }

    public function create(): AuthorizationManagerInterface
    {
        return new AuthorizationManager(
            $this->oauth2ClientFacade,
            $this->securityFacade,
            $this->securityTokenDataExpanderFactory->create(),
            $this->tokenTransferExpanderFactory->create(),
        );
    }
}
