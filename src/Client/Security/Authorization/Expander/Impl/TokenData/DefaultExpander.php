<?php

declare(strict_types=1);

namespace MicroCRM\Client\Security\Authorization\Expander\Impl\TokenData;

use MicroCRM\Client\Security\Authorization\Expander\SecurityTokenDataExpanderInterface;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Token\AccessToken;

class DefaultExpander implements SecurityTokenDataExpanderInterface
{
    public function expand(array &$tokenData, AccessToken $accessToken, AbstractProvider $provider): void
    {
        $values                 = $accessToken->getValues();
        $timeNow                = $accessToken->getTimeNow();
        $tokenData['rt']        = $accessToken->getRefreshToken();
        $tokenData['tn']        = $timeNow;
        $tokenData['exp']       = $timeNow + (int) $values['refresh_expires_in'];
        $tokenData['exp_ta']    = (int) $accessToken->getExpires();
    }
}
