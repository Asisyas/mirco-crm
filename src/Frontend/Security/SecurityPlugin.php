<?php

declare(strict_types=1);

namespace MicroCRM\Frontend\Security;

use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\ConfigurableInterface;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;
use Micro\Framework\Kernel\Plugin\PluginConfigurationTrait;
use Micro\Plugin\OAuth2\Client\Facade\Oauth2ClientFacadeInterface;
use MicroCRM\Client\Security\Client\SecurityClientInterface;
use MicroCRM\Frontend\Security\AuthConfig\AuthConfigurationFactory;
use MicroCRM\Frontend\Security\AuthConfig\AuthConfigurationFactoryInterface;
use MicroCRM\Frontend\Security\AuthConfig\Expander\AuthConfigTransferExpanderFactory;
use MicroCRM\Frontend\Security\AuthConfig\Expander\AuthConfigTransferExpanderFactoryInterface;
use MicroCRM\Frontend\Security\AuthConfig\Expander\Impl\OAuth2Expander;
use MicroCRM\Frontend\Security\Authenticator\AuthenticatorFactoryInterface;
use MicroCRM\Frontend\Security\Authenticator\HeaderAuthenticatorFactory;
use MicroCRM\Frontend\Security\Configuration\SecurityPluginConfigurationInterface;
use MicroCRM\Frontend\Security\Facade\SecurityFacade;
use MicroCRM\Frontend\Security\Facade\SecurityFacadeInterface;
use MicroCRM\Frontend\Security\Token\Factory\AuthTokenFactory;
use MicroCRM\Frontend\Security\Token\Factory\AuthTokenFactoryInterface;

/**
 * @method SecurityPluginConfigurationInterface configuration()
 */
class SecurityPlugin implements ConfigurableInterface, DependencyProviderInterface
{
    use PluginConfigurationTrait;

    private readonly SecurityClientInterface $securityClient;

    private readonly Oauth2ClientFacadeInterface $oauth2ClientFacade;

    public function provideDependencies(Container $container): void
    {
        $container->register(SecurityFacadeInterface::class, function (
            SecurityClientInterface     $securityClient,
            Oauth2ClientFacadeInterface $oauth2ClientFacade
        ) {
            $this->securityClient       = $securityClient;
            $this->oauth2ClientFacade   = $oauth2ClientFacade;

            return $this->createFacade();
        });
    }

    protected function createFacade(): SecurityFacadeInterface
    {
        return new SecurityFacade(
            $this->createAuthenticatorFactory(),
            $this->createAuthConfigurationFactory(),
        );
    }

    protected function createAuthConfigurationFactory(): AuthConfigurationFactoryInterface
    {
        return new AuthConfigurationFactory(
            $this->createAuthConfigExpanderFactory()
        );
    }

    protected function createAuthConfigExpanderFactory(): AuthConfigTransferExpanderFactoryInterface
    {
        return new AuthConfigTransferExpanderFactory(
            new OAuth2Expander($this->oauth2ClientFacade)
        );
    }

    protected function createAuthenticatorFactory(): AuthenticatorFactoryInterface
    {
        return new HeaderAuthenticatorFactory(
            $this->securityClient,
            $this->createAuthTokenFactory(),
            $this->configuration()
        );
    }

    protected function createAuthTokenFactory(): AuthTokenFactoryInterface
    {
        return new AuthTokenFactory();
    }
}
