<?php

namespace App\Common\Exceptions;

use App\Common\HttpStatusCodes;

class NotYetImplementedException extends \Exception
{
    protected $code = HttpStatusCodes::STATUS_NOT_IMPLEMENTED;
}