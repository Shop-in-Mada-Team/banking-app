<?php

namespace Shopinmada\BankingApp\Domain\Entity;

use Shopinmada\BankingApp\Domain\Enum\TransactionType;
use Shopinmada\BankingApp\Domain\ValueObject\MoneyInterface;

class BankTransaction
{
    private \DateTimeImmutable $transactionDate;

    public function __construct(private readonly BankAccount $bankAccount, private readonly TransactionType $transactionType, private readonly MoneyInterface $amount)
    {
        $this->transactionDate = new \DateTimeImmutable();
    }

    public function getMoney(): MoneyInterface
    {
        return $this->amount;
    }

    public function getTransactionType(): TransactionType
    {
        return $this->transactionType;
    }

    public function getTransactionDate(): \DateTimeImmutable
    {
        return $this->transactionDate;
    }

    public function getBankAccount(): BankAccount
    {
        return $this->bankAccount;
    }
}