<?php

declare(strict_types=1);

namespace MicroCRM\Frontend\Security\AuthConfig\Expander;

use MicroCRM\Shared\DTO\Security\AuthConfigurationTransfer;

readonly class AuthConfigTransferExpander implements AuthConfigTransferExpanderInterface
{
    /**
     * @param iterable<AuthConfigTransferExpanderInterface> $expanderCollection
     */
    public function __construct(
        private iterable $expanderCollection
    ) {
    }

    public function expand(AuthConfigurationTransfer $authConfigurationTransfer): void
    {
        foreach ($this->expanderCollection as $expander) {
            $expander->expand($authConfigurationTransfer);
        }
    }
}
