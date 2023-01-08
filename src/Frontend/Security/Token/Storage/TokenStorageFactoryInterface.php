<?php

namespace MicroCRM\Frontend\Security\Token\Storage;

use MicroCRM\Frontend\Security\Token\Model\AuthTokenInterface;

interface TokenStorageFactoryInterface
{
    public function create(AuthTokenInterface $authToken): TokenStorageInterface;
}
