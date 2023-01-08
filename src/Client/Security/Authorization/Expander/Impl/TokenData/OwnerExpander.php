<?php

declare(strict_types=1);

namespace MicroCRM\Client\Security\Authorization\Expander\Impl\TokenData;

use MicroCRM\Client\Security\Authorization\Expander\SecurityTokenDataExpanderInterface;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Token\AccessToken;

class OwnerExpander implements SecurityTokenDataExpanderInterface
{
    public function expand(array &$tokenData, AccessToken $accessToken, AbstractProvider $provider): void
    {
        $owner = $provider->getResourceOwner($accessToken);
        $ownerData = $owner->toArray();
        $id = $owner->getId();
        $ownerData['id'] = $id;
        unset($ownerData['sub']);

        $tokenData['u'] = $ownerData;
    }
}
