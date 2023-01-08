<?php

declare(strict_types=1);

namespace MicroCRM\Client\Security\Authorization\Expander\Impl\TokenTransfer;

use MicroCRM\Client\Security\Authorization\Expander\TokenTransferExpanderInterface;
use MicroCRM\Shared\DTO\Security\TokenOwnerTransfer;
use MicroCRM\Shared\DTO\Security\TokenTransfer;
use Micro\Plugin\Security\Token\TokenInterface;

class OwnerExpander implements TokenTransferExpanderInterface
{
    public function expand(TokenTransfer $tokenTransfer, TokenInterface $token): void
    {
        $userData = $token->getParameter('u', []);

        $tokenOwner = new TokenOwnerTransfer();
        $tokenOwner
            ->setEmail($userData['email'])
            ->setNameFirst($userData['given_name'])
            ->setNameLast($userData['family_name'])
            ->setId($userData['id']);

        $tokenTransfer->setUser($tokenOwner);
    }
}
