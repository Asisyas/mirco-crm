<?php

namespace MicroCRM\Frontend\React\Controller;

use MicroCRM\Frontend\React\Facade\ReactFacadeInterface;
use Symfony\Component\HttpFoundation\Response;

readonly class ReactController
{
    /**
     * @param ReactFacadeInterface $reactFacade
     */
    public function __construct(private ReactFacadeInterface $reactFacade)
    {
    }

    public function index(): Response
    {
        return new Response($this->reactFacade->renderReact());
    }
}
