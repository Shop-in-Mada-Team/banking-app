<?php

namespace Shopinmada\BankingApp\Domain\ValueObject;

interface MoneyInterface
{
    public function currency(): Currency;

    public function amount(): int;

    public function equals(MoneyInterface $money): bool;

    public function add(MoneyInterface $money): void;

    public function subtracts(MoneyInterface $money): void;
}