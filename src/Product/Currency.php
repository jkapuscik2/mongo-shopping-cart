<?php

declare(strict_types=1);

namespace App\Product;

use App\Product\Exceptions\InvalidCurrencyException;

final class Currency
{

    private string $currency;
    private const AVAILABLE_CURRENCIES = ["PLN", "EUR", "USD"];

    public function __construct(?string $currency)
    {
        if (is_null($currency) || !in_array($currency, self::AVAILABLE_CURRENCIES)) {
            throw new InvalidCurrencyException("Invalid currency provided {$currency}");
        }

        $this->currency = $currency;
    }

    public function get(): string
    {
        return $this->currency;
    }
}