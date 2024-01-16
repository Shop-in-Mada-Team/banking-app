<?php

namespace Shopinmada\BankingApp\Domain\ValueObject;

final readonly class Currency
{
    private function __construct(private string $isoCode)
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