<?php

declare(strict_types=1);

namespace MicroCRM\Client\Security\Authorization\Expander;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Token\AccessToken;

interface SecurityTokenDataExpanderInterface
{
    public function expand(array &$tokenData, AccessToken $accessToken, AbstractProvider $provider): void;
}
