<?php

namespace Shopinmada\BankingApp\Domain\Entity;

use Shopinmada\BankingApp\Domain\Enum\TransactionType;
use Shopinmada\BankingApp\Domain\ValueObject\MoneyInterface;

class BankTransaction
{
    private \DateTimeImmutable $transactionDate;

    public function __construct(
        private readonly BankAccount $bankAccount,
        private readonly TransactionType $transactionType,
        private readonly MoneyInterface $amount,
        private readonly string $motif
    ) {
        $this->transactionDate = new \DateTimeImmutable();
    }


    public function getMotif(): string
    {
        return $this->motif;
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

    public static function retrait(BankAccount $bankAccount, MoneyInterface $money, string $raison): BankTransaction
    {
        return new self($bankAccount, TransactionType::RETRAIT, $money, $raison);
    }

    public static function transfert(BankAccount $bankAccount, MoneyInterface $money, string $raison): BankTransaction
    {
        return new self($bankAccount, TransactionType::TRANSFER, $money, $raison);
    }

    public static function deposit(BankAccount $bankAccount, MoneyInterface $money, string $raison): BankTransaction
    {
        return new self($bankAccount, TransactionType::DEPOSIT, $money, $raison);
    }

    public function __toString(): string
    {
        return sprintf(
            "%s | %s | %s",
            $this->transactionDate->format('Y-m-d'),
            $this->motif,
            $this->amount
        );
    }
}