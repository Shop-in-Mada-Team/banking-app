<?php


use Shopinmada\BankingApp\BankAccount;

require_once __DIR__ . '/vendor/autoload.php';

$accountOne = new BankAccount(1, 100);
$accountTwo = new BankAccount(2, 300);
$accountOne->deposit(500);
$accountOne->deposit(1000);
dump('kkk!');
dump($accountOne . '');
dump($accountTwo . '');
$accountOne->transfert($accountTwo, 1000);
echo"hello";
dump($accountTwo . '');
dump($accountOne . '');
echo "Hello";

