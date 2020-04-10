<?php

declare(strict_types=1);

namespace App\Product\Exceptions;

use App\Common\HttpStatusCodes;

class InvalidCurrencyException extends \InvalidArgumentException
{
    protected $code = HttpStatusCodes::STATUS_BAD_REQUEST;
}