<?php

declare(strict_types=1);

namespace MicroCRM\Client\Security\Authorization\Expander;

readonly class TokenTransferExpanderFactory implements TokenTransferExpanderFactoryInterface
{
    /**
     * @var iterable<TokenTransferExpanderInterface>
     */
    private iterable $expanderCollection;

    /**
     * @param TokenTransferExpanderInterface ...$expanderCollection
     */
    public function __construct(TokenTransferExpanderInterface ...$expanderCollection)
    {
        $this->expanderCollection = $expanderCollection;
    }

    public function create(): TokenTransferExpanderInterface
    {
        return new TokenTransferExpander($this->expanderCollection);
    }
}
