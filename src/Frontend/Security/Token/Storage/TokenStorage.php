<?php

namespace MicroCRM\Frontend\Security\Token\Storage;

use MicroCRM\Frontend\Security\Token\Model\AuthTokenInterface;

readonly class TokenStorage implements TokenStorageInterface
{
    public function __construct(
        private AuthTokenInterface $authToken
    ) {
    }

    public function getAuthToken(): AuthTokenInterface
    {
        return $this->authToken;
    }
}
