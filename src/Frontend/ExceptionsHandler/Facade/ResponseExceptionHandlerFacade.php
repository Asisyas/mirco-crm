<?php

declare(strict_types=1);

namespace MicroCRM\Frontend\ExceptionsHandler\Facade;

use Micro\Plugin\Http\Handler\Response\ResponseHandlerContextInterface;
use Micro\Plugin\Http\Handler\Response\ResponseHandlerInterface;

readonly class ResponseExceptionHandlerFacade implements ResponseExceptionHandlerFacadeInterface
{
    public function __construct(private ResponseHandlerInterface $responseHandler)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function handle(ResponseHandlerContextInterface $responseHandlerContext): void
    {
        $this->responseHandler->handle($responseHandlerContext);
    }
}
