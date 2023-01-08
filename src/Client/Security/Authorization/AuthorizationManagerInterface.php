<?php

declare(strict_types=1);

namespace MicroCRM\Client\Security\Authorization;

use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use MicroCRM\Shared\DTO\Security\AuthCodeRequestTransfer;
use MicroCRM\Shared\DTO\Security\TokenTransfer;

interface AuthorizationManagerInterface
{
    /**
     * @throws IdentityProviderException
     */
    public function authorizeByCode(AuthCodeRequestTransfer $authCodeRequestTransfer): TokenTransfer;

    /**
     * @throws IdentityProviderException
     */
    public function refreshToken(TokenTransfer $tokenTransfer): void;

    public function decodeToken(TokenTransfer $tokenTransfer): void;
}
