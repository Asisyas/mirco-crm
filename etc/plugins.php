<?php

declare(strict_types=1);

return [
    // Core plugins
    Micro\Plugin\Locator\LocatorPlugin::class,
    Micro\Plugin\Configuration\Helper\ConfigurationHelperPlugin::class,
    Micro\Plugin\Http\HttpPlugin::class,
    Micro\Plugin\Console\ConsolePlugin::class,
    Micro\Plugin\Logger\Monolog\MonologPlugin::class,
    Micro\Plugin\Twig\TwigPlugin::class,
    //

    MicroCRM\Frontend\React\ReactPlugin::class,
    OleksiiBulba\WebpackEncorePlugin\WebpackEncorePlugin::class,
    // MicroCRM\User\UserPlugin::class,
    MicroCRM\Frontend\Security\SecurityPlugin::class,
    MicroCRM\Client\Security\SecurityClientPlugin::class,
    Micro\Plugin\Security\SecurityPlugin::class,
    Micro\Plugin\OAuth2\Client\OAuth2ClientPlugin::class,
    MicroCRM\Frontend\ExceptionsHandler\ExceptionsHandlerPlugin::class,
    Micro\Plugin\OAuth2\Client\Keycloak\OAuth2KeycloakProviderPlugin::class,
    MicroCRM\Common\Serializer\SerializerPlugin::class,
];
