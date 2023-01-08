<?php

declare(strict_types=1);

namespace MicroCRM\Frontend\Security\Facade;

use MicroCRM\Frontend\Security\AuthConfig\AuthConfigurationFactoryInterface;
use MicroCRM\Frontend\Security\Authenticator\AuthenticatorFactoryInterface;
use MicroCRM\Frontend\Security\Token\Model\AuthTokenInterface;
use MicroCRM\Shared\DTO\Security\AuthConfigurationTransfer;
use Symfony\Component\HttpFoundation\Request;

readonly class SecurityFacade implements SecurityFacadeInterface
{
    private AuthTokenInterface $authToken;

    public function __construct(
        private AuthenticatorFactoryInterface $authenticatorFactory,
        private AuthConfigurationFactoryInterface $authConfigurationFactory
    ) {
    }

    public function authenticateRequest(Request $request): AuthTokenInterface
    {
        $this->authToken = $this->authenticatorFactory
            ->create()
            ->authenticateRequest($request);

        return $this->authToken;
    }

    public function getAuthToken(): AuthTokenInterface
    {
        return $this->authToken;
    }

    public function getAuthConfiguration(): AuthConfigurationTransfer
    {
        return $this
            ->authConfigurationFactory
            ->create();
    }
}
