<?php

declare(strict_types=1);

namespace MicroCRM\Client\Security\Authorization;

use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Micro\Plugin\OAuth2\Client\Facade\Oauth2ClientFacadeInterface;
use Micro\Plugin\Security\Exception\TokenExpiredException;
use Micro\Plugin\Security\Facade\SecurityFacadeInterface;
use Micro\Plugin\Security\Token\TokenInterface;
use MicroCRM\Client\Security\Authorization\Expander\SecurityTokenDataExpanderInterface;
use MicroCRM\Client\Security\Authorization\Expander\TokenTransferExpanderInterface;
use MicroCRM\Shared\DTO\Security\AuthCodeRequestTransfer;
use MicroCRM\Shared\DTO\Security\TokenTransfer;

readonly class AuthorizationManager implements AuthorizationManagerInterface
{
    public function __construct(
        private Oauth2ClientFacadeInterface $oauth2ClientFacade,
        private SecurityFacadeInterface $securityFacade,
        private SecurityTokenDataExpanderInterface $securityTokenDataExpander,
        private TokenTransferExpanderInterface $tokenTransferExpander
    ) {
    }

    /**
     * {@inheritdoc}
     */
    public function authorizeByCode(AuthCodeRequestTransfer $authCodeRequestTransfer): TokenTransfer
    {
        $tokenData = [];
        $providerName = $authCodeRequestTransfer->getProvider();
        $code = $authCodeRequestTransfer->getCode();
        $provider = $this->oauth2ClientFacade->getProvider($providerName);
        $accessToken = $provider->getAccessToken('authorization_code', [
            'code'  => $code,
        ]);

        $tokenTransfer  = new TokenTransfer();
        $this->securityTokenDataExpander->expand($tokenData, $accessToken, $provider);
        $tokenGenerated = $this->securityFacade->generateToken($tokenData);
        $this->tokenTransferExpander->expand($tokenTransfer, $tokenGenerated);

        return $tokenTransfer;
    }

    /**
     * {@inheritdoc}
     */
    public function refreshToken(TokenTransfer $tokenTransfer): void
    {
        $encoded = $tokenTransfer->getToken();
        $decoded = $this->securityFacade->decodeToken($encoded);
        $provider = $this->oauth2ClientFacade->getProvider('default');
        $tokenData = [];

        $tokenGenerated = $provider->getAccessToken('refresh_token', [
            'refresh_token' => $decoded->getParameter('rt', ''),
        ]);

        $this->securityTokenDataExpander->expand($tokenData, $tokenGenerated, $provider);
        $tokenGenerated = $this->securityFacade->generateToken($tokenData);
        $this->tokenTransferExpander->expand($tokenTransfer, $tokenGenerated);
    }

    public function decodeToken(TokenTransfer $tokenTransfer): void
    {
        $tokenData = $this->securityFacade->decodeToken($tokenTransfer->getToken());

        $this->checkAccessTokenExpired($tokenData);
    }

    protected function checkAccessTokenExpired(TokenInterface $token): void
    {
        $tokenExpTime = (int) $token->getParameter('exp_ta', null);
        if (!$tokenExpTime) {
            return;
        }

        if (time() >= $tokenExpTime) {
            throw new TokenExpiredException($token->getSource());
        }
    }
}
