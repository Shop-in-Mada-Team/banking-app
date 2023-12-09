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

    public function retrait(int $montant)
    {
        if ($montant > $this->amount) {
            throw new \InvalidArgumentException("Votre solde est insuffisante!");
        }
        $this->amount = $this->amount - $montant;
    }

    public function __toString(): string
    {
        return sprintf("Ar %d", $this->getAmount());
    }
}