<?php

namespace MicroCRM\Frontend\Security\Token\Storage;

use MicroCRM\Frontend\Security\Token\Model\AuthTokenInterface;

interface TokenStorageInterface
{
    public function getAuthToken(): AuthTokenInterface;
}
