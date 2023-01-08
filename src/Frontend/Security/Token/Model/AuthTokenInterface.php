<?php

namespace MicroCRM\Frontend\Security\Token\Model;

interface AuthTokenInterface
{
    public function getUserId(): ?string;

    /**
     * @return string[]
     */
    public function getRoles(): array;

    public function getExpired(): int;
}
