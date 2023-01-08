<?php

namespace MicroCRM\Frontend\Security\Token\Model;

use MicroCRM\Shared\DTO\Security\TokenTransfer;

readonly class AuthToken implements AuthTokenInterface
{
    public function __construct(private TokenTransfer $token)
    {
    }

    public function getUserId(): null|string
    {
        return $this->token->getUser()->getId();
    }

    /**
     * {@inheritdoc}
     */
    public function getRoles(): array
    {
        return [];
    }

    public function getExpired(): int
    {
        return $this->token->getExpiresAtAccess();
    }

    public function getSource(): string
    {
        return $this->token->getToken();
    }
}
