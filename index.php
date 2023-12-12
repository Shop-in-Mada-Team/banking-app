<?php


use Shopinmada\BankingApp\BankAccount;
use Shopinmada\BankingApp\BankAccountId;
use Shopinmada\BankingApp\Money;

require_once __DIR__ . '/vendor/autoload.php';

$accountOne = new BankAccount(BankAccountId::fromInt(1), Money::fromAmount('MGA', 100));
$accountTwo = new BankAccount(BankAccountId::fromInt(2), Money::fromAmount('MGA', 300));
$accountOne->deposit(Money::fromAmount('MGA', 500));
$accountOne->deposit(Money::fromAmount('MGA', 1000));

dump($accountOne . '');
dump($accountTwo . '');
$accountOne->transfert($accountTwo, Money::fromAmount('MGA', 1000));

dump($accountTwo . '');
dump($accountOne . '');

