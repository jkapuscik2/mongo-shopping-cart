<?php

declare(strict_types=1);

namespace App\Product\Exceptions;

use App\Common\HttpStatusCodes;

class InvalidPriceException extends \RangeException
{
    protected $code = HttpStatusCodes::STATUS_BAD_REQUEST;
}