<?php

declare(strict_types=1);

namespace MicroCRM\Frontend\Security\AuthConfig\Expander;

readonly class AuthConfigTransferExpanderFactory implements AuthConfigTransferExpanderFactoryInterface
{
    /**
     * @var iterable<AuthConfigTransferExpanderInterface>
     */
    private iterable $expanderCollection;

    public function __construct(
        AuthConfigTransferExpanderInterface ...$expanderCollection
    ) {
        $this->expanderCollection = $expanderCollection;
    }

    public function create(): AuthConfigTransferExpanderInterface
    {
        return new AuthConfigTransferExpander($this->expanderCollection);
    }
}
