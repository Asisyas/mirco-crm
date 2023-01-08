<?php

declare(strict_types=1);

namespace MicroCRM\Frontend\Common\ResponseTransformer;

use Micro\Plugin\Http\Handler\Response\ResponseHandlerContextInterface;
use Micro\Plugin\Http\Handler\Response\ResponseHandlerInterface;
use MicroCRM\Frontend\ExceptionsHandler\Facade\ResponseExceptionHandlerFacadeInterface;

readonly class ResponseExceptionHandler implements ResponseHandlerInterface
{
    public function __construct(private ResponseExceptionHandlerFacadeInterface $responseExceptionHandlerFacade)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function handle(ResponseHandlerContextInterface $responseHandlerContext): void
    {
        if (null === $responseHandlerContext->getException()) {
            return;
        }

        $this->responseExceptionHandlerFacade->handle($responseHandlerContext);
    }
}
