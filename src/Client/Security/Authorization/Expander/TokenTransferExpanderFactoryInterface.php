<?php

declare(strict_types=1);

namespace MicroCRM\Client\Security\Authorization\Expander;

interface TokenTransferExpanderFactoryInterface
{
    public function create(): TokenTransferExpanderInterface;
}
