<?php

declare(strict_types=1);

namespace App\Product\Exceptions;

use App\Common\HttpStatusCodes;

class InvalidNameException extends \LengthException
{
    protected $code = HttpStatusCodes::STATUS_BAD_REQUEST;
}