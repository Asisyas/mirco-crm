<?php

declare(strict_types=1);

namespace MicroCRM\Frontend\User\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetUserController
{
    public function index(Request $request): Response
    {
        return new JsonResponse(['greeting' => $this->getGreeting($request)]);
    }

    private function getGreeting(Request $request): string
    {
        return sprintf('Hello world, %s', $request->query->get('user', 'anonymous'));
    }
}
