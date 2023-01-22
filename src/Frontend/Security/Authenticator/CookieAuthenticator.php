<?php

declare(strict_types=1);

namespace MicroCRM\Frontend\Security\Authenticator;

use Firebase\JWT\ExpiredException;
use Micro\Plugin\Http\Exception\HttpAccessDeniedException;
use Micro\Plugin\Http\Exception\HttpBadRequestException;
use Micro\Plugin\Security\Exception\TokenExpiredException;
use MicroCRM\Client\Security\Client\SecurityClientInterface;
use MicroCRM\Frontend\Security\Configuration\SecurityPluginConfigurationInterface;
use MicroCRM\Frontend\Security\Token\Factory\AuthTokenFactoryInterface;
use MicroCRM\Frontend\Security\Token\Model\AuthTokenInterface;
use MicroCRM\Shared\DTO\Security\TokenTransfer;
use Symfony\Component\HttpFoundation\Request;

class CookieAuthenticator implements AuthenticatorInterface
{
    const TOKEN_NOT_FOUND = 'Cookie token was not found.';
    const TOKEN_INVALID = 'Invalid cookie token';

    public function __construct(
        private readonly SecurityClientInterface $securityClient,
        private readonly AuthTokenFactoryInterface $authTokenFactory,
        private readonly SecurityPluginConfigurationInterface $securityPluginConfiguration
    ) {
    }

    /**
     * @inheritDoc
     */
    public function authenticateRequest(Request $request): AuthTokenInterface
    {
        $tokenRawData = $request->cookies->get($this->securityPluginConfiguration->getAuthCookieName());
        if (!$tokenRawData) {
            throw new HttpAccessDeniedException(self::TOKEN_NOT_FOUND);
        }

//        preg_match('/Bearer\s((.*)\.(.*)\.(.*))/', $tokenRawData, $tokenRawDataExploded);

//        $tokenRaw = $tokenRawDataExploded[1] ?? null;
        $tokenRaw = $tokenRawData;

        if (!$tokenRaw) {
            throw new HttpBadRequestException(self::TOKEN_INVALID);
        }

        $tokenTransfer = new TokenTransfer();
        $tokenTransfer->setToken($tokenRaw);

        try {
            $this->securityClient->decodeToken($tokenTransfer);
        } catch (TokenExpiredException|ExpiredException $exception) {
            throw new HttpAccessDeniedException($exception->getMessage(), $exception);
        } catch (\UnexpectedValueException $exception) {
            throw new HttpBadRequestException(self::TOKEN_INVALID, $exception);
        }

        return $this->authTokenFactory->create($tokenTransfer);
    }
}
