<?php

declare(strict_types=1);

namespace MicroCRM\Frontend\Security\Authenticator;

use Micro\Plugin\Http\Exception\HttpException;
use MicroCRM\Frontend\Security\Token\Model\AuthTokenInterface;
use Symfony\Component\HttpFoundation\Request;

interface AuthenticatorInterface
{
    /**
     * @throws HttpException
     */
    public function authenticateRequest(Request $request): AuthTokenInterface;
}
