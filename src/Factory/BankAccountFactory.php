<?php

namespace Shopinmada\BankingApp\Factory;

use Ramsey\Uuid\Uuid;
use Shopinmada\BankingApp\Domain\Entity\BankAccount;
use Shopinmada\BankingApp\Domain\Exception\InvalidBankAccountNameException;
use Shopinmada\BankingApp\Domain\ValueObject\BankAccountId;
use Shopinmada\BankingApp\Domain\ValueObject\BankAccountName;
use Shopinmada\BankingApp\Domain\ValueObject\Money;

final class BankAccountFactory
{
    /**
     * @param string $currencyCode
     * @param string $banAccountName
     * @param int $amount
     * @return BankAccount
     * @throws InvalidBankAccountNameException
     */
    public static function create(string $currencyCode, string $banAccountName, int $amount): BankAccount
    {
        return new BankAccount(
            BankAccountId::fromUuid(uuid: Uuid::uuid4()),
            new BankAccountName($banAccountName),
            Money::fromAmount($currencyCode, $amount)
        );
    }
}