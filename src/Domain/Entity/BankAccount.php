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
        $this->bankAccountId      = $bankAccountId;
        $this->money              = $money;
        $this->bankTransactions[] = BankTransaction::deposite(
            $this,
            $money,
            "Ouverture d'un compte bancaire avec solde initiale"
        );
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

    public function deposit(MoneyInterface $money, string $raison): void
    {
        $this->money->add($money);
        $bankTransaction          = new BankTransaction($this, TransactionType::DEPOSIT, $money, $raison);
        $this->bankTransactions[] = $bankTransaction;
    }

    public function retrait(MoneyInterface $money, string $motif): void
    {
        if ($money->amount() > $this->money->amount()) {
            throw new \InvalidArgumentException("Votre solde est insuffisante!");
        }
        $this->money->subtracts($money);
        $this->bankTransactions[] = BankTransaction::retrait($this, $money, $motif);
    }

    public function transfert(BankAccount $recipientAccount, MoneyInterface $money, string $raison): void
    {
        $this->retrait($money, $raison);
        $recipientAccount->deposit($money, $raison);
        $bankTransaction          = BankTransaction::transfert($this, $money, $raison);
        $this->bankTransactions[] = $bankTransaction;
    }

    public function transactions(): array
    {
        return $this->bankTransactions;
    }

    public function countTransaction(): int
    {
        return count($this->transactions());
    }

    public function __toString(): string
    {
        return sprintf(
            "[%s] BankAccount #%s avec solde: Ar %d",
            (new \DateTime())->format('Y-m-d'),
            $this->bankAccountId,
            $this->getAmount()
        );
    }
}