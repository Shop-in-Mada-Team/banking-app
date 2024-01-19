<?php


use Shopinmada\BankingApp\Domain\ValueObject\BankAccountId;
use Shopinmada\BankingApp\Domain\ValueObject\Money;
use Shopinmada\BankingApp\Repository\BankAccountInMemoryRepository;
use Shopinmada\BankingApp\Service\BankAccountService;

require_once __DIR__ . '/vendor/autoload.php';

$bankAccountRepository = new BankAccountInMemoryRepository();
$bankAccountId = (new BankAccountService($bankAccountRepository))->createAccount(15000);

dump($bankAccountId);

sleep(5);
$bankAccount = $bankAccountRepository->get(BankAccountId::fromUuid($bankAccountId));
$bankAccount->deposit(Money::fromAmount('MGA', 7000), 'Virement salaire mois de janvier!');
$bankAccount->deposit(Money::fromAmount('MGA', 7000), 'Rembouressement frais médicaux');
dump($bankAccount->countTransaction());
dump($bankAccount->transactions());
dump($bankAccount . '');
