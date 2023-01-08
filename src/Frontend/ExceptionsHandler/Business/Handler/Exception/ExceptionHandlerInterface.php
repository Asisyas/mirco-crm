<?php

declare(strict_types=1);

namespace MicroCRM\Frontend\ExceptionsHandler\Business\Handler\Exception;

use Micro\Plugin\Http\Handler\Response\ResponseHandlerInterface;

interface ExceptionHandlerInterface extends ResponseHandlerInterface
{
    public function supports(\Throwable $throwable): bool;
}
