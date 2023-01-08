<?php

declare(strict_types=1);

namespace MicroCRM\Frontend\Security\Facade;

use MicroCRM\Frontend\Security\Authenticator\AuthenticatorInterface;
use MicroCRM\Frontend\Security\Token\Storage\TokenStorageInterface;
use MicroCRM\Shared\DTO\Security\AuthConfigurationTransfer;

interface SecurityFacadeInterface extends
    AuthenticatorInterface,
    TokenStorageInterface
{
    public function getAuthConfiguration(): AuthConfigurationTransfer;
}
