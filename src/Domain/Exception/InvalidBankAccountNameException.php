<?php

namespace Shopinmada\BankingApp\Domain\Exception;

final class InvalidBankAccountNameException extends \Exception
{

    public static function ShouldNotEmpty(): InvalidBankAccountNameException
    {
       return new self('Bank account name cannot be empty.');
    }

    public static function ShouldGreaterThanFiveCharacter(): InvalidBankAccountNameException
    {
        return new self('Bank account name cannot be greater than 5 characters.');
    }
}