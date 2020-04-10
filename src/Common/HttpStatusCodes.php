<?php

declare(strict_types=1);

namespace App\Common;

class HttpStatusCodes
{
    const STATUS_OK = 200;
    const STATUS_CREATED = 201;
    const STATUS_OK_NO_CONTENT = 204;

    const STATUS_BAD_REQUEST = 400;
    const STATUS_NOT_FOUND = 404;

    const STATUS_NOT_IMPLEMENTED = 501;
    const STATUS_BAD_GATEWAY = 502;
}