<?php

declare(strict_types=1);

namespace MicroCRM\Frontend\Common\ResponseTransformer;

use Micro\Plugin\Http\Handler\Response\ResponseHandlerContextInterface;
use Micro\Plugin\Http\Handler\Response\ResponseHandlerInterface;
use MicroCRM\Common\Serializer\Facade\SerializerFacadeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

readonly class ResponseTransformerHandler implements ResponseHandlerInterface
{
    public function __construct(private SerializerFacadeInterface $serializerFacade)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function handle(ResponseHandlerContextInterface $responseHandlerContext): void
    {
        $responseData = $responseHandlerContext->getResponse();
        if ($responseData instanceof Response) {
            return;
        }

        $response = new JsonResponse($this->serializerFacade->normalize($responseData, ''));

        $responseHandlerContext->setResponse($response);
    }
}
