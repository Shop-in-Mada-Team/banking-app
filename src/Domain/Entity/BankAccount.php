<?php

namespace Shopinmada\BankingApp\Domain\Entity;

use Shopinmada\BankingApp\Domain\Enum\TransactionType;
use Shopinmada\BankingApp\Domain\ValueObject\BankAccountId;
use Shopinmada\BankingApp\Domain\ValueObject\MoneyInterface;

class BankAccount
{
    private BankAccountId $bankAccountId;
    private MoneyInterface $money;
    private array $bankTransactions;

    /**
     * @param BankAccountId $bankAccountId
     * @param MoneyInterface $money
     */
    public function __construct(BankAccountId $bankAccountId, MoneyInterface $money)
    {
        $this->bankAccountId = $bankAccountId;
        $this->money = $money;
        $this->bankTransactions = [];
    }

    public function getId(): BankAccountId
    {
        return $this->bankAccountId;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->money->amount();
    }

    public function deposit(MoneyInterface $money): void
    {
        $this->money->add($money);
        $bankTransaction = new BankTransaction(bankAccount: $this, transactionType: TransactionType::DEPOSIT, amount: $money);
        $this->bankTransactions[] = $bankTransaction;
    }

    public function retrait(MoneyInterface $money): void
    {
        if ($money->amount() > $this->money->amount()) {
            throw new \InvalidArgumentException("Votre solde est insuffisante!");
        }
        $this->money->subtracts($money);
        $bankTransaction = new BankTransaction(bankAccount: $this, transactionType: TransactionType::RETRAIT, amount: $money);
        $this->bankTransactions[] = $bankTransaction;
    }

    public function transfert(BankAccount $recipientAccount, MoneyInterface $money): void
    {
        $this->retrait($money);
        $recipientAccount->deposit($money);
        $bankTransaction = new BankTransaction(bankAccount: $this, transactionType: TransactionType::TRANSFER, amount: $money);
        $this->bankTransactions[] = $bankTransaction;
    }

    public function transactions(): array
    {
        return $this->bankTransactions;
    }

    public function __toString(): string
    {
        return sprintf("BankAccount # %s : Ar %d", $this->bankAccountId, $this->getAmount());
    }
}