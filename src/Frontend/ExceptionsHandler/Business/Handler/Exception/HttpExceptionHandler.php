<?php

declare(strict_types=1);

namespace MicroCRM\Frontend\ExceptionsHandler\Business\Handler\Exception;

use Http\Client\Exception\HttpException;
use Micro\Plugin\Http\Handler\Response\ResponseHandlerContextInterface;
use Symfony\Component\HttpFoundation\Response;

class HttpExceptionHandler implements ExceptionHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public function handle(ResponseHandlerContextInterface $responseHandlerContext): void
    {
        $exception = $responseHandlerContext->getException();
        if (!$exception) {
            return;
        }

        $responseHandlerContext->setResponse(
            new Response(
                $exception->getMessage(),
                $exception->getCode()
            )
        );
    }

    public function supports(\Throwable $throwable): bool
    {
        return $throwable instanceof HttpException;
    }
}
