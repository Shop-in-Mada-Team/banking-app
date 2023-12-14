<?php

namespace Shopinmada\BankingApp\Repository;

use Shopinmada\BankingApp\Domain\Entity\BankAccount;
use Shopinmada\BankingApp\Domain\ValueObject\BankAccountId;

final class BankAccountInMemoryRepository implements BankAccountRepositoryInterface
{
    private array $bankAccounts;

    public function __construct()
    {
        $this->bankAccounts = [];
    }

    public function add(BankAccount $bankAccount)
    {
        $this->bankAccounts[] = $bankAccount;
    }

    public function get(BankAccountId $bankAccountId): BankAccount
    {
        [$bankAccount] = array_filter($this->bankAccounts, fn(BankAccount $ba) => $ba->getId() == $bankAccountId);
        return $bankAccount;
    }

    public function findById(BankAccountId $bankAccountId): ?BankAccount
    {
        try {
            [$bankAccount] = array_filter($this->bankAccounts, fn(BankAccount $ba) => $ba->getId() == $bankAccountId);
            return $bankAccount;
        } catch (\Exception $exception) {
            return null;
        }
    }

    public function remove(BankAccount $bankAccount)
    {
        if (!$this->findById($bankAccount->getId())) {
            throw new \InvalidArgumentException(sprintf("Unable to remove bank account %d", $bankAccount->getId()));
        }
        $this->bankAccounts = array_filter($this->bankAccounts, fn(BankAccount $ba) => $ba->getId() != $bankAccount->getId());
    }
}