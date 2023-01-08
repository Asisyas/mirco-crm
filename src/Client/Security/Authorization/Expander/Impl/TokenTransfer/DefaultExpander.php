<?php

declare(strict_types=1);

namespace MicroCRM\Client\Security\Authorization\Expander\Impl\TokenTransfer;

use MicroCRM\Client\Security\Authorization\Expander\TokenTransferExpanderInterface;
use MicroCRM\Shared\DTO\Security\TokenTransfer;
use Micro\Plugin\Security\Token\TokenInterface;

class DefaultExpander implements TokenTransferExpanderInterface
{
    public function expand(TokenTransfer $tokenTransfer, TokenInterface $token): void
    {
        $tokenAccessExpiredAt = $token->getParameter('exp_ta', null);
        $tokenRefreshExpiredAt = $token->getParameter('exp', 0);
        $tokenTransfer
            ->setExpiresAtAccess((int) $tokenAccessExpiredAt)
            ->setExpiresAtRefresh((int) $tokenRefreshExpiredAt)
            ->setTimeNow($token->getParameter('tn', 0))
            ->setToken($token->getSource());
    }
}
