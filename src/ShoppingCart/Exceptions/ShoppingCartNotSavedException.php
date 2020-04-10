<?php

declare(strict_types=1);

namespace App\ShoppingCart\Exceptions;

use App\Common\HttpStatusCodes;

class ShoppingCartNotSavedException extends \Exception
{
    protected $code = HttpStatusCodes::STATUS_BAD_GATEWAY;
}