<?php


use Shopinmada\BankingApp\Domain\ValueObject\BankAccountId;
use Shopinmada\BankingApp\Domain\ValueObject\Money;
use Shopinmada\BankingApp\Repository\BankAccountInMemoryRepository;
use Shopinmada\BankingApp\Service\BankAccountService;

require_once __DIR__ . '/vendor/autoload.php';

$bankAccountRepository = new BankAccountInMemoryRepository();
$bankAccountService = new BankAccountService($bankAccountRepository);
$bankAccountId = $bankAccountService->createAccount(15000);

dump($bankAccountId);

sleep(5);
$bankAccount = $bankAccountRepository->get(BankAccountId::fromUuid($bankAccountId));
$bankAccount->deposit(Money::fromAmount('MGA', 7000), 'Virement salaire mois de janvier!');
sleep(5);
$bankAccount->deposit(Money::fromAmount('MGA', 7000), 'Rembouressement frais médicaux');
sleep(5);
$bankAccount->deposit(Money::fromAmount('MGA', 8500), 'Payement freelance');
sleep(10);
dump($bankAccountService->fetchTransactionsById($bankAccount->getId()));