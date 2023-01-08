<?php

declare(strict_types=1);

namespace MicroCRM\Frontend\Security\Handler\Request;

use Micro\Plugin\Http\Handler\Request\RequestHandlerContextInterface;
use Micro\Plugin\Http\Handler\Request\RequestHandlerInterface;
use MicroCRM\Frontend\Security\Facade\SecurityFacadeInterface;

class RequestHeaderAuthenticateHandler implements RequestHandlerInterface
{
    private SecurityFacadeInterface $securityFacade;

    public function __construct(SecurityFacadeInterface $securityFacade)
    {
        $this->securityFacade = $securityFacade;
    }

    public function handle(RequestHandlerContextInterface $requestHandlerContext): void
    {
        $this->securityFacade->authenticateRequest($requestHandlerContext->getRequest());
    }
}
