<?php

declare(strict_types=1);

namespace MicroCRM\Frontend\ExceptionsHandler;

use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;
use Micro\Plugin\Http\Handler\Response\ResponseHandlerInterface;
use MicroCRM\Frontend\ExceptionsHandler\Business\Handler\Exception\HttpBadRequestExceptionHandler;
use MicroCRM\Frontend\ExceptionsHandler\Business\Handler\Exception\HttpExceptionHandler;
use MicroCRM\Frontend\ExceptionsHandler\Business\Handler\Response\ResponseExceptionHandler;
use MicroCRM\Frontend\ExceptionsHandler\Facade\ResponseExceptionHandlerFacade;
use MicroCRM\Frontend\ExceptionsHandler\Facade\ResponseExceptionHandlerFacadeInterface;

class ExceptionsHandlerPlugin implements DependencyProviderInterface
{
    public function provideDependencies(Container $container): void
    {
        $container->register(ResponseExceptionHandlerFacadeInterface::class, function () {
            return $this->createExceptionHandlerFacade();
        });
    }

    protected function createExceptionHandlerFacade(): ResponseExceptionHandlerFacadeInterface
    {
        return new ResponseExceptionHandlerFacade($this->createExceptionHandler());
    }

    protected function createExceptionHandler(): ResponseHandlerInterface
    {
        return new ResponseExceptionHandler($this->createExceptionHandlerCollection());
    }

    protected function createExceptionHandlerCollection(): iterable
    {
        yield new HttpBadRequestExceptionHandler();
        yield new HttpExceptionHandler();
    }
}
