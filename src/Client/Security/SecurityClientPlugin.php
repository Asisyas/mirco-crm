<?php

declare(strict_types=1);

namespace MicroCRM\Client\Security;

use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;
use Micro\Plugin\OAuth2\Client\Facade\Oauth2ClientFacadeInterface;
use Micro\Plugin\Security\Facade\SecurityFacadeInterface;
use MicroCRM\Client\Security\Authorization\AuthorizationManagerFactory;
use MicroCRM\Client\Security\Authorization\AuthorizationManagerFactoryInterface;
use MicroCRM\Client\Security\Authorization\Expander\Impl\TokenData\DefaultExpander as TokenDataExpanderDefault;
use MicroCRM\Client\Security\Authorization\Expander\Impl\TokenData\OwnerExpander as TokenDataExpanderOwner;
use MicroCRM\Client\Security\Authorization\Expander\Impl\TokenTransfer\DefaultExpander as TokenTransferExpanderDefault;
use MicroCRM\Client\Security\Authorization\Expander\Impl\TokenTransfer\OwnerExpander as TokenTransferExpanderOwner;
use MicroCRM\Client\Security\Authorization\Expander\SecurityTokenDataExpanderFactory;
use MicroCRM\Client\Security\Authorization\Expander\SecurityTokenDataExpanderFactoryInterface;
use MicroCRM\Client\Security\Authorization\Expander\TokenTransferExpanderFactory;
use MicroCRM\Client\Security\Authorization\Expander\TokenTransferExpanderFactoryInterface;
use MicroCRM\Client\Security\Client\SecurityClient;
use MicroCRM\Client\Security\Client\SecurityClientInterface;

class SecurityClientPlugin implements DependencyProviderInterface
{
    public function provideDependencies(Container $container): void
    {
        $container->register(SecurityClientInterface::class, function (
            SecurityFacadeInterface $securityFacade,
            Oauth2ClientFacadeInterface $oauth2ClientFacade
        ) {
            return $this->createClient($securityFacade, $oauth2ClientFacade);
        });
    }

    private function createClient(
        SecurityFacadeInterface $securityFacade,
        Oauth2ClientFacadeInterface $oauth2ClientFacade
    ): SecurityClientInterface {
        return new SecurityClient(
            $this->createAuthorizationManagerFactory($securityFacade, $oauth2ClientFacade)
        );
    }

    private function createAuthorizationManagerFactory(
        SecurityFacadeInterface $securityFacade,
        Oauth2ClientFacadeInterface $oauth2ClientFacade
    ): AuthorizationManagerFactoryInterface {
        return new AuthorizationManagerFactory(
            $oauth2ClientFacade,
            $securityFacade,
            $this->createSecurityTokenDataExpanderFactory(),
            $this->createTokenTransferExpanderFactory()
        );
    }

    /**
     * @return TokenTransferExpanderFactoryInterface
     */
    protected function createTokenTransferExpanderFactory(): TokenTransferExpanderFactoryInterface
    {
        return new TokenTransferExpanderFactory(
            new TokenTransferExpanderDefault(),
            new TokenTransferExpanderOwner(),
        );
    }

    /**
     * @return SecurityTokenDataExpanderFactoryInterface
     */
    protected function createSecurityTokenDataExpanderFactory(): SecurityTokenDataExpanderFactoryInterface
    {
        return new SecurityTokenDataExpanderFactory(
            new TokenDataExpanderDefault(),
            new TokenDataExpanderOwner(),
        );
    }
}
