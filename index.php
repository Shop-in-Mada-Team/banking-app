<?php


use Shopinmada\BankingApp\Domain\Entity\BankTransaction;
use Shopinmada\BankingApp\Domain\Exception\InvalidBankAccountNameException;
use Shopinmada\BankingApp\Domain\ValueObject\BankAccountId;
use Shopinmada\BankingApp\Domain\ValueObject\Money;
use Shopinmada\BankingApp\Repository\BankAccountInMemoryRepository;
use Shopinmada\BankingApp\Service\BankAccountService;

require_once __DIR__ . '/vendor/autoload.php';

$bankAccountRepository = new BankAccountInMemoryRepository();
$bankAccountService    = new BankAccountService($bankAccountRepository);
try {
    $bankAccountId = $bankAccountService->createAccount('Principal Account', 15000);


    $bankAccount = $bankAccountRepository->get(BankAccountId::fromUuid($bankAccountId));
    //dump($bankAccount . '');
    $bankAccount->deposit(Money::fromAmount('MGA', 7000), 'Virement salaire mois de janvier!');
    $bankAccount->deposit(Money::fromAmount('MGA', 7000), 'Rembouressement frais médicaux');
    $bankAccount->deposit(Money::fromAmount('MGA', 8500), 'Payement freelance');
    $transactions = $bankAccount->transactions();

    /**@var BankTransaction $transaction */
    foreach ($transactions as $transaction) {
        dump($transaction . '');
    }
} catch (InvalidBankAccountNameException $e) {
}
