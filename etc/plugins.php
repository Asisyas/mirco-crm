<?php

declare(strict_types=1);

use MicroCRM\Frontend;

return [
    // Core plugins
    Micro\Plugin\Locator\LocatorPlugin::class,
    Micro\Plugin\Configuration\Helper\ConfigurationHelperPlugin::class,
    Micro\Plugin\Http\HttpPlugin::class,
    Micro\Plugin\Console\ConsolePlugin::class,
    Micro\Plugin\Logger\Monolog\MonologPlugin::class,
    //

    // Frontend plugins
    Frontend\Security\SecurityPlugin::class,
    Frontend\React\ReactPlugin::class,
    Frontend\ExceptionsHandler\ExceptionsHandlerPlugin::class,
    Frontend\User\UserFrontendPlugin::class,

    MicroCRM\Client\Security\SecurityClientPlugin::class,
    Micro\Plugin\Security\SecurityPlugin::class,
    Micro\Plugin\OAuth2\Client\OAuth2ClientPlugin::class,
    Micro\Plugin\OAuth2\Client\Keycloak\OAuth2KeycloakProviderPlugin::class,
    MicroCRM\Common\Serializer\SerializerPlugin::class,
];
