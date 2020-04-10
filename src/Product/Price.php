<?php

declare(strict_types=1);

namespace App\Product;

use App\Product\Exceptions\InvalidPriceException;

final class Price
{
    private const MAX_PRECISION = 2;
    private string $amount;

    public function __construct(?string $amount)
    {
        if (is_null($amount) || !is_numeric($amount) || $this->getPrecision($amount) > self::MAX_PRECISION) {
            throw new InvalidPriceException(sprintf('Invalid price provided: %s', $amount));
        }

        $this->amount = $amount;
    }

    public function getPrecision($amount)
    {
        if ($precision = strrchr($amount, '.')) {
            return strlen(substr($precision, 1));
        } else {
            return 0;
        }
    }

    public function get(): string
    {
        return sprintf('%0.2f', $this->amount);
    }
}