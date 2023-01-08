<?php

declare(strict_types=1);

namespace MicroCRM\Client\Security\Authorization\Expander;

readonly class SecurityTokenDataExpanderFactory implements SecurityTokenDataExpanderFactoryInterface
{
    /**
     * @var iterable<SecurityTokenDataExpanderInterface>
     */
    private iterable $expanderCollection;

    public function __construct(SecurityTokenDataExpanderInterface ...$expanderCollection)
    {
        $this->expanderCollection = $expanderCollection;
    }

    public function create(): SecurityTokenDataExpanderInterface
    {
        return new SecurityTokenDataExpander($this->expanderCollection);
    }
}
