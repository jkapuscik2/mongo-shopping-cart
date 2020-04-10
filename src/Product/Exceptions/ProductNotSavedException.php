<?php

declare(strict_types=1);

namespace App\Product\Exceptions;

use App\Common\HttpStatusCodes;

class ProductNotSavedException extends \Exception
{
    protected $code = HttpStatusCodes::STATUS_BAD_GATEWAY;
}