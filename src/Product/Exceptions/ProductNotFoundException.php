<?php

namespace App\Product\Exceptions;

use App\Common\HttpStatusCodes;
use DomainException;

class ProductNotFoundException extends DomainException
{
    protected $code = HttpStatusCodes::STATUS_NOT_FOUND;
}