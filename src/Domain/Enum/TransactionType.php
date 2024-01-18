<?php

namespace Shopinmada\BankingApp\Domain\Enum;

enum TransactionType: string
{
    case DEPOSIT = 'deposit';
    case TRANSFER = 'transfer';
    case RETRAIT = 'retrait';
}