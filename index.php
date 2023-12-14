<?php


use Shopinmada\BankingApp\Domain\ValueObject\BankAccountId;
use Shopinmada\BankingApp\Repository\BankAccountInMemoryRepository;
use Shopinmada\BankingApp\Service\BankAccountService;

require_once __DIR__ . '/vendor/autoload.php';

$bankAccountRepository = new BankAccountInMemoryRepository();
$bankAccountId = (new BankAccountService($bankAccountRepository))->createAccount(15000);

dump($bankAccountId);

sleep(5);
$bankAccount = $bankAccountRepository->get(BankAccountId::fromUuid($bankAccountId));

dump($bankAccount . '');
