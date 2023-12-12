<?php

namespace Shopinmada\BankingApp;

final class Currency
{
    private function __construct(private readonly string $isoCode)
    {

    }

    public static function fromIsoCode(string $isoCode): self
    {
        return new self($isoCode);
    }

    public function __toString(): string
    {
        return $this->isoCode;
    }
}