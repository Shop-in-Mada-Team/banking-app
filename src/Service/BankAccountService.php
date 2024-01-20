<?php

namespace Shopinmada\BankingApp\Service;

use Shopinmada\BankingApp\Domain\ValueObject\BankAccountId;
use Shopinmada\BankingApp\Domain\ValueObject\Money;
use Shopinmada\BankingApp\Factory\BankAccountFactory;
use Shopinmada\BankingApp\Repository\BankAccountRepositoryInterface;

final class BankAccountService
{
    public function __construct(private readonly BankAccountRepositoryInterface $bankAccountRepository)
    {
    }

    public function createAccount(int $amount): string
    {
        $bankAccount = BankAccountFactory::create('MGA', $amount);
        $this->bankAccountRepository->add($bankAccount);
        return $bankAccount->getId();
    }

    public function depositMoney(BankAccountId $bankAccountId, int $amount, string $reason)
    {
        $bankAccount = $this->bankAccountRepository->get($bankAccountId);
        $bankAccount->deposit(Money::fromAmount('MGA', $amount), $reason);
        $this->bankAccountRepository->add($bankAccount);
    }

    public function retraitMoney(BankAccountId $bankAccountId, int $amount, string $reason)
    {
        $bankAccount = $this->bankAccountRepository->get($bankAccountId);
        $bankAccount->retrait(Money::fromAmount('MGA', $amount), $reason);
        $this->bankAccountRepository->add($bankAccount);
    }

    public function transfertMoney(string $bankAccountSender, string $bankAccountRecipient, int $amount, string $reason)
    {
        $senderAccount = $this->bankAccountRepository->get(BankAccountId::fromInt($bankAccountSender));
        $recipientAccount = $this->bankAccountRepository->get(BankAccountId::fromInt($bankAccountRecipient));
        $senderAccount->transfert($recipientAccount, Money::fromAmount('MGA', $amount), $reason);
    }

    public function fetchTransactionsById(BankAccountId $bankAccountId): array
    {
        return $this->bankAccountRepository->get($bankAccountId)
            ->transactions();
    }
}