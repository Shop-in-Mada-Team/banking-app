<?php

namespace Shopinmada\BankingApp\Domain\ValueObject;

final readonly class BankAccountId
{

    public function __construct(private string $id)
    {
    }

    public static function fromInt(int $id): self
    {
        return new self($id);
    }
    public static function fromUuid(string $uuid): self
    {
        return new self($uuid);
    }

    public function __toString(): string
    {
        return $this->id;
    }
}