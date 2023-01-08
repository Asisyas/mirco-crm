<?php

declare(strict_types=1);

namespace MicroCRM\Frontend\Security\AuthConfig\Expander;

interface AuthConfigTransferExpanderFactoryInterface
{
    public function create(): AuthConfigTransferExpanderInterface;
}
