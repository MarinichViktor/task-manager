<?php

namespace App\Exception;

use Throwable;


class ValidationException extends AppException
{
    protected const MESSAGE = 'Validation exception occurred';

    public function __construct($message = null)
    {
        parent::__construct($message ?? static::MESSAGE);
    }
}
