<?php

declare(strict_types=1);

namespace MicroCRM\Frontend\ExceptionsHandler\Business\Handler\Exception;

use Micro\Plugin\Http\Exception\HttpBadRequestException;
use Micro\Plugin\Http\Handler\Response\ResponseHandlerContextInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class HttpBadRequestExceptionHandler implements ExceptionHandlerInterface
{
    public function supports(\Throwable $throwable): bool
    {
        return $throwable instanceof HttpBadRequestException;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(ResponseHandlerContextInterface $responseHandlerContext): void
    {
        $exception = $responseHandlerContext->getException();
        if (!$exception instanceof HttpBadRequestException) {
            return;
        }

        $sourceConstraintsViolations = $exception->getSource();
        $message = $exception->getMessage();
        $response = new Response('', Response::HTTP_BAD_REQUEST);
        if ($sourceConstraintsViolations !== null) {
            $message = json_encode($this->buildMessage($sourceConstraintsViolations)) ?: '[]';
            $response->headers->set('Content-Type', 'application/json');
        }

        $responseHandlerContext->setResponse(
            $response->setContent($message)
        );
    }

    private function buildMessage(ConstraintViolationListInterface $violations): array
    {
        $errors = [];

        /** @var ConstraintViolation $violation */
        foreach ($violations as $violation) {
            $errors[
                rtrim(ltrim($violation->getPropertyPath(), '['), ']')
            ] = $violation->getMessage();
        }


        return $errors;
    }
}
