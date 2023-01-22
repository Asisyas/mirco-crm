<?php

declare(strict_types=1);

namespace MicroCRM\Frontend\Security\Handler\Response;

use Micro\Plugin\Http\Handler\Response\ResponseHandlerContextInterface;
use Micro\Plugin\Http\Handler\Response\ResponseHandlerInterface;
use MicroCRM\Shared\DTO\Security\TokenTransfer;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ResponseCookieAuthenticateHandler implements ResponseHandlerInterface
{
    /**
     * @inheritDoc
     */
    public function handle(ResponseHandlerContextInterface $responseHandlerContext): void
    {
        $previousResponse = $responseHandlerContext->getResponse();

        if (!$previousResponse instanceof TokenTransfer) {
            return;
        }

        $response = new RedirectResponse('/');
        $cookie = new Cookie(
            'token',
            $previousResponse->getToken(),
            $previousResponse->getExpiresAtAccess(),
            '/',
            null,
            true,
            true
        );
        $response->headers->setCookie($cookie);
        $responseHandlerContext->setResponse($response);
    }
}