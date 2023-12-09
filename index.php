<?php


use Shopinmada\BankingApp\BankAccount;

require_once __DIR__ . '/vendor/autoload.php';

$accountOne = new BankAccount(1, 100);
$accountTwo = new BankAccount(2, 300);
$accountOne->deposit(500);
$accountOne->deposit(1000);

dump($accountOne . '');

try {
    $accountOne->retrait(2000);
    dump($accountOne . '');
} catch (InvalidArgumentException $exception) {
    dump($exception->getMessage());
}

