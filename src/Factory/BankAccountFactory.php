<?php

namespace Shopinmada\BankingApp\Factory;

use Ramsey\Uuid\Uuid;
use Shopinmada\BankingApp\BankAccount;
use Shopinmada\BankingApp\BankAccountId;
use Shopinmada\BankingApp\Money;

final class BankAccountFactory
{
    public static function create(string $currencyCode, int $amount): BankAccount
    {
        return new BankAccount(BankAccountId::fromUuid(uuid: Uuid::uuid4()), Money::fromAmount($currencyCode, $amount));
    }
}