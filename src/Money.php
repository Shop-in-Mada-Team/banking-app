<?php

namespace Shopinmada\BankingApp;

final class Money implements MoneyInterface
{
    public function __construct(private readonly Currency $currency, private int $amount)
    {
    }

    public function currency(): Currency
    {
        return $this->currency;
    }

    public function amount(): int
    {
        return $this->amount;
    }

    public function equals(MoneyInterface $money): bool
    {
        return $this->currency() === $money->currency() && $this->amount == $money->amount();
    }

    public function __toString(): string
    {
        return sprintf("%d %s", $this->amount(), $this->currency());
    }

    public function add(MoneyInterface $money): void
    {
        $this->amount = $this->amount + $money->amount();
    }

    public function subtracts(MoneyInterface $money): void
    {
        $this->amount = $this->amount - $money->amount();
    }

    public static function fromAmount(string $isoCode, int $amount): Money
    {
        return new self(Currency::fromIsoCode($isoCode), $amount);
    }
}