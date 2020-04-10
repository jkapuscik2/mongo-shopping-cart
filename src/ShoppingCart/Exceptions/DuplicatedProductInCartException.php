<?php

declare(strict_types=1);

namespace App\ShoppingCart\Exceptions;

use App\Common\HttpStatusCodes;
use DomainException;

class DuplicatedProductInCartException extends DomainException
{
    protected $code = HttpStatusCodes::STATUS_BAD_REQUEST;
}