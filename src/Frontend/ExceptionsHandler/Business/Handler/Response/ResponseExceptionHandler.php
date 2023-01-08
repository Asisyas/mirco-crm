<?php

declare(strict_types=1);

namespace MicroCRM\Frontend\ExceptionsHandler\Business\Handler\Response;

use Micro\Plugin\Http\Handler\Response\ResponseHandlerContextInterface;
use Micro\Plugin\Http\Handler\Response\ResponseHandlerInterface;
use MicroCRM\Frontend\ExceptionsHandler\Business\Handler\Exception\ExceptionHandlerInterface;

class ResponseExceptionHandler implements ResponseHandlerInterface
{
    /**
     * @var ExceptionHandlerInterface[]
     */
    private array $exceptionHandlerCollection;

    public function __construct(iterable $handlerCollection)
    {
        $this->exceptionHandlerCollection = $handlerCollection instanceof \Traversable ?
            iterator_to_array($handlerCollection) :
            $handlerCollection;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(ResponseHandlerContextInterface $responseHandlerContext): void
    {
        $exception = $responseHandlerContext->getException();
        if (!$exception) {
            return;
        }

        foreach ($this->exceptionHandlerCollection as $handler) {
            if ($handler->supports($exception)) {
                $handler->handle($responseHandlerContext);
            }
        }
    }
}
