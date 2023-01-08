<?php

declare(strict_types=1);

namespace MicroCRM\Frontend\Security\Controller;

use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Micro\Plugin\Http\Exception\HttpAccessDeniedException;
use Micro\Plugin\Http\Exception\HttpBadRequestException;
use MicroCRM\Client\Security\Client\SecurityClientInterface;
use MicroCRM\Shared\DTO\Security\AuthCodeRequestTransfer;
use MicroCRM\Shared\DTO\Security\TokenTransfer;
use Symfony\Component\HttpFoundation\Request;

class AuthorizationController
{
    private SecurityClientInterface $securityClient;

    public function __construct(SecurityClientInterface $securityClient)
    {
        $this->securityClient = $securityClient;
    }

    /**
     * @throws HttpAccessDeniedException|HttpBadRequestException|IdentityProviderException
     */
    public function processCodeRequest(Request $request): TokenTransfer
    {
        $codeParameter = 'code';
        if (!$request->query->has($codeParameter)) {
            $this->throwInvalidParameterException('code');
        }

        $code = $request->query->get($codeParameter);
        if ($code === null || !\mb_strlen($code)) {
            $this->throwInvalidParameterException('code');
        }

        $provider = 'default';
        $authCodeRequestTransfer = new AuthCodeRequestTransfer();
        $authCodeRequestTransfer
            ->setCode($code)
            ->setProvider($provider);

        return $this->securityClient->authorizeByCode($authCodeRequestTransfer);
    }

    /**
     * @throws IdentityProviderException
     */
    public function refreshToken(Request $request): TokenTransfer
    {
        if (!$request->query->has('token')) {
            $this->throwInvalidParameterException('token');
        }

        $tokenRaw = $request->query->get('token');
        $tokenTransfer = new TokenTransfer();
        $tokenTransfer->setToken($tokenRaw);

        $this->securityClient->refreshToken($tokenTransfer);

        return $tokenTransfer;
    }

    /**
     * @throws HttpBadRequestException
     */
    protected function throwInvalidParameterException(string $parameter): void
    {
        throw new HttpBadRequestException(
            sprintf('The "%s" parameter is missing or invalid in the request.', $parameter)
        );
    }
}
