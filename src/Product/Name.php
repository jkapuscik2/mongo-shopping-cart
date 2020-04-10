<?php

declare(strict_types=1);

namespace App\Product;

use App\Product\Exceptions\InvalidNameException;

final class Name
{
    private const MAX_LEN = 255;
    private const MIN_LEN = 10;
    private string $name;

    public function __construct(string $name)
    {
        if (!$name || mb_strlen($name) <= self::MIN_LEN || mb_strlen($name) >= self::MAX_LEN) {
            throw new InvalidNameException(sprintf('Product name hast to be between %d and %d characters', self::MIN_LEN, self::MAX_LEN));
        }
        $this->name = $name;
    }

    public function get(): string
    {
        return $this->name;
    }
}