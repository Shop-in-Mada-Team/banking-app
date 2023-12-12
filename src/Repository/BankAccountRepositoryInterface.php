<?php

namespace Shopinmada\BankingApp\Repository;

use Shopinmada\BankingApp\BankAccount;
use Shopinmada\BankingApp\BankAccountId;

interface BankAccountRepositoryInterface
{
    public function add(BankAccount $bankAccount);

    public function get(BankAccountId $bankAccountId): BankAccount;

    public function findById(BankAccountId $bankAccountId): ?BankAccount;

    public function remove(BankAccount $bankAccount);
}