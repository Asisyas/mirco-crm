<?php

declare(strict_types=1);

namespace MicroCRM\Shared\DTO\Security;

class TokenTransfer
{
    protected ?string $token = null;
    protected ?int $timeNow = null;
    protected ?int $expiresAtAccess = null;
    protected ?int $expiresAtRefresh = null;
    protected ?TokenOwnerTransfer $user = null;

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function getTimeNow(): ?int
    {
        return $this->timeNow;
    }

    public function getExpiresAtAccess(): ?int
    {
        return $this->expiresAtAccess;
    }

    public function getExpiresAtRefresh(): ?int
    {
        return $this->expiresAtRefresh;
    }

    public function getUser(): ?TokenOwnerTransfer
    {
        return $this->user;
    }

    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function setTimeNow(?int $timeNow): self
    {
        $this->timeNow = $timeNow;

        return $this;
    }

    public function setExpiresAtAccess(?int $expiresAtAccess): self
    {
        $this->expiresAtAccess = $expiresAtAccess;

        return $this;
    }

    public function setExpiresAtRefresh(?int $expiresAtRefresh): self
    {
        $this->expiresAtRefresh = $expiresAtRefresh;

        return $this;
    }

    public function setUser(?TokenOwnerTransfer $user): self
    {
        $this->user = $user;

        return $this;
    }
}
