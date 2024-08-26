<?php

namespace Shopinmada\BankingApp\Domain\ValueObject;

use Shopinmada\BankingApp\Domain\Exception\InvalidBankAccountNameException;

final class BankAccountName
{
    private string $bankAccountName;

    /**
     * @throws InvalidBankAccountNameException
     */
    public function __construct(string $bankAccountName)
    {
        if (empty($bankAccountName)) {
            throw  InvalidBankAccountNameException::ShouldNotEmpty();
        }
        if (strlen($bankAccountName) < 5) {
            throw InvalidBankAccountNameException::ShouldGreaterThanFiveCharacter();
        }
        $this->bankAccountName = $bankAccountName;
    }

    public function __toString(): string
    {
        return $this->bankAccountName;
    }
}