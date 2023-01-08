<?php

declare(strict_types=1);

namespace MicroCRM\Client\Security\Authorization\Expander;

interface SecurityTokenDataExpanderFactoryInterface
{
    public function create(): SecurityTokenDataExpanderInterface;
}
