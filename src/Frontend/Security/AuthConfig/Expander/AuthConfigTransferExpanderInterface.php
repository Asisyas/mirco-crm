<?php

declare(strict_types=1);

namespace MicroCRM\Frontend\Security\AuthConfig\Expander;

use MicroCRM\Shared\DTO\Security\AuthConfigurationTransfer;

interface AuthConfigTransferExpanderInterface
{
    public function expand(AuthConfigurationTransfer $authConfigurationTransfer): void;
}
