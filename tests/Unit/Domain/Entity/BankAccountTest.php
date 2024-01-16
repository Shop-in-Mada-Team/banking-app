<?php

use Shopinmada\BankingApp\Domain\Entity\BankAccount;
use Shopinmada\BankingApp\Domain\ValueObject\BankAccountId;
use Shopinmada\BankingApp\Domain\ValueObject\Money;

beforeEach(function () {
    $this->bankAccount = new BankAccount(
        BankAccountId::fromInt(5), Money::fromAmount('MGA', 1800)
    );
});

describe('Test BankAccount functionalities', function () {

    it('should return the string BankAccount # 5 : Ar 1800', function () {
        expect($this->bankAccount . '')
            ->toBeString()
            ->toEqual("BankAccount # 5 : Ar 1800");
    });

    test('deposit 500 MAG to the account should increase amount into 2300 MGA', function (Money $money) {
        $this->bankAccount->deposit($money);
        expect($this->bankAccount->getAmount())->toBeInt()
            ->toEqual(2300);
    })->with([
        fn() => Money::fromAmount('MGA', 500)
    ]);

    test('When I withdraw 1000 MGA from my account then the amount should decrease into 800 MGA', function (Money $money) {
        $this->bankAccount->retrait($money);
        expect($this->bankAccount->getAmount())->toEqual(800);
    })->with([fn() => Money::fromAmount('MGA', 1000)]);

    it('should return an instance of BankAccountId', function () {
        expect($this->bankAccount->getId())->toBeInstanceOf(BankAccountId::class);
    });

});
