<?php

declare(strict_types=1);

namespace MicroCRM\Shared\DTO\Security;

class TokenOwnerTransfer
{
    protected ?string $id = null;
    protected ?string $email = null;
    protected ?string $nameFirst = null;
    protected ?string $nameLast = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getNameFirst(): ?string
    {
        return $this->nameFirst;
    }

    public function getNameLast(): ?string
    {
        return $this->nameLast;
    }

    public function setId(?string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function setNameFirst(?string $nameFirst): self
    {
        $this->nameFirst = $nameFirst;

        return $this;
    }

    public function setNameLast(?string $nameLast): self
    {
        $this->nameLast = $nameLast;

        return $this;
    }
}
