<?php

declare(strict_types=1);

namespace MicroCRM\Client\Security\Authorization\Expander;

use MicroCRM\Shared\DTO\Security\TokenTransfer;
use Micro\Plugin\Security\Token\TokenInterface;

interface TokenTransferExpanderInterface
{
    public function expand(TokenTransfer $tokenTransfer, TokenInterface $token): void;
}
