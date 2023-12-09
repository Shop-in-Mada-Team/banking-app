<?php

namespace Shopinmada\BankingApp;

class BankAccount
{
    private string $id;
    private int $amount;

    /**
     * @param string $id
     * @param int $amount
     */
    public function __construct(string $id, int $amount)
    {
        $this->id = $id;
        $this->amount = $amount;
    }

    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    private function getAmount(): string
    {
        return $this->amount;
    }

    public function deposit(int $montant): void
    {
        $this->amount = $this->amount + $montant;
    }

    public function retrait(int $montant): void
    {
        if ($montant > $this->amount) {
            throw new \InvalidArgumentException("Votre solde est insuffisante!");
        }
        $this->amount = $this->amount - $montant;
    }

    public function transfert(BankAccount $recipientAccount, int $amount): void
    {
        dump(sprintf("Transférer un montant de %d du compte %s vers le compte %s", $amount, $this->id, $recipientAccount->getId()));
        $this->retrait($amount);
        $recipientAccount->deposit($amount);
    }

    public function __toString(): string
    {
        return sprintf("BankAccount # %s : Ar %d", $this->id, $this->getAmount());
    }
}