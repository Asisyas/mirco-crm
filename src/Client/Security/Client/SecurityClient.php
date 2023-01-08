<?php

declare(strict_types=1);

namespace MicroCRM\Client\Security\Client;

use MicroCRM\Client\Security\Authorization\AuthorizationManagerFactoryInterface;
use MicroCRM\Shared\DTO\Security\AuthCodeRequestTransfer;
use MicroCRM\Shared\DTO\Security\TokenTransfer;

readonly class SecurityClient implements SecurityClientInterface
{
    public function __construct(private AuthorizationManagerFactoryInterface $authorizationManagerFactory)
    {
    }

    public function authorizeByCode(AuthCodeRequestTransfer $authCodeRequestTransfer): TokenTransfer
    {
        return $this->authorizationManagerFactory
            ->create()
            ->authorizeByCode($authCodeRequestTransfer);
    }

    public function refreshToken(TokenTransfer $tokenTransfer): void
    {
        $this->authorizationManagerFactory
            ->create()
            ->refreshToken($tokenTransfer);
    }

    public function decodeToken(TokenTransfer $tokenTransfer): void
    {
        $this->authorizationManagerFactory
            ->create()
            ->decodeToken($tokenTransfer);
    }
}
