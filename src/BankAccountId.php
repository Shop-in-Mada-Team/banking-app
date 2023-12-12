<?php

namespace Shopinmada\BankingApp;

final class BankAccountId
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public static function fromInt(int $id): self
    {
        return new self($id);
    }

    public function __toString(): string
    {
        return $this->id;
    }
}