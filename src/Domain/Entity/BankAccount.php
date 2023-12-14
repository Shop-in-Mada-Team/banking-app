<?php

namespace Shopinmada\BankingApp\Domain\Entity;

use Shopinmada\BankingApp\Domain\ValueObject\BankAccountId;
use Shopinmada\BankingApp\Domain\ValueObject\MoneyInterface;

class BankAccount
{
    private BankAccountId $bankAccountId;
    private MoneyInterface $money;

    /**
     * @param BankAccountId $bankAccountId
     * @param MoneyInterface $money
     */
    public function __construct(BankAccountId $bankAccountId, MoneyInterface $money)
    {
        $this->bankAccountId = $bankAccountId;
        $this->money = $money;
    }

    public function getId(): BankAccountId
    {
        return $this->bankAccountId;
    }

    /**
     * @return string
     */
    private function getAmount(): string
    {
        return $this->money->amount();
    }

    public function deposit(MoneyInterface $money): void
    {
        $this->money->add($money);
    }

    public function retrait(MoneyInterface $money): void
    {
        if ($money->amount() > $this->money->amount()) {
            throw new \InvalidArgumentException("Votre solde est insuffisante!");
        }
        $this->money->subtracts($money);
    }

    public function transfert(BankAccount $recipientAccount, MoneyInterface $money): void
    {
        dump(sprintf("Transférer un montant de %d du compte %s vers le compte %s", $money->amount(), $this->bankAccountId, $recipientAccount->getId()));
        $this->retrait($money);
        $recipientAccount->deposit($money);
    }

    public function __toString(): string
    {
        return sprintf("BankAccount # %s : Ar %d", $this->bankAccountId, $this->getAmount());
    }
}