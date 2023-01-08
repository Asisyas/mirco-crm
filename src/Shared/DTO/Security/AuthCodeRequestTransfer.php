<?php

declare(strict_types=1);

namespace MicroCRM\Shared\DTO\Security;

class AuthCodeRequestTransfer
{
    protected ?string $code = null;
    protected ?string $provider = null;

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function getProvider(): ?string
    {
        return $this->provider;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function setProvider(?string $provider): self
    {
        $this->provider = $provider;

        return $this;
    }
}
