<?php

declare(strict_types=1);

namespace MicroCRM\Client\Security\Authorization\Expander;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Token\AccessToken;

readonly class SecurityTokenDataExpander implements SecurityTokenDataExpanderInterface
{
    /**
     * @param iterable<SecurityTokenDataExpanderInterface> $expanderCollection
     */
    public function __construct(private iterable $expanderCollection)
    {
    }

    public function expand(array &$tokenData, AccessToken $accessToken, AbstractProvider $provider): void
    {
        foreach ($this->expanderCollection as $expander) {
            $expander->expand($tokenData, $accessToken, $provider);
        }
    }
}
