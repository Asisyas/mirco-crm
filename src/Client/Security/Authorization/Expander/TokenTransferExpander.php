<?php

declare(strict_types=1);

namespace MicroCRM\Client\Security\Authorization\Expander;

use MicroCRM\Shared\DTO\Security\TokenTransfer;
use Micro\Plugin\Security\Token\TokenInterface;

readonly class TokenTransferExpander implements TokenTransferExpanderInterface
{
    /**
     * @param iterable<TokenTransferExpanderInterface> $expanderCollection
     */
    public function __construct(private iterable $expanderCollection)
    {
    }

    public function expand(TokenTransfer $tokenTransfer, TokenInterface $token): void
    {
        foreach ($this->expanderCollection as $expander) {
            $expander->expand($tokenTransfer, $token);
        }
    }
}
