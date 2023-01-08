<?php

declare(strict_types=1);

namespace MicroCRM\Shared\DTO\Security;

class AuthConfigurationTransfer
{
    protected ?string $provider = null;
    protected string $urlAuth;

    public function getProvider(): ?string
    {
        return $this->provider;
    }

    public function getUrlAuth(): string
    {
        return $this->urlAuth;
    }

    public function setProvider(?string $provider): self
    {
        $this->provider = $provider;

        return $this;
    }

    public function setUrlAuth(string $urlAuth): self
    {
        $this->urlAuth = $urlAuth;

        return $this;
    }
}
