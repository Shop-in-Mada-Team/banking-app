<?php

namespace Shopinmada\BankingApp\Factory;

use Ramsey\Uuid\Uuid;
use Shopinmada\BankingApp\Domain\Entity\BankAccount;
use Shopinmada\BankingApp\Domain\ValueObject\BankAccountId;
use Shopinmada\BankingApp\Domain\ValueObject\Money;

final class BankAccountFactory
{
    public static function create(string $currencyCode, int $amount): BankAccount
    {
        return new BankAccount(BankAccountId::fromUuid(uuid: Uuid::uuid4()), Money::fromAmount($currencyCode, $amount));
    }
}