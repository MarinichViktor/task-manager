<?php

namespace App\Exception;

use Throwable;


class DatabaseException extends AppException
{
    protected const MESSAGE = 'Database exception occurred';

    public function __construct($message = null)
    {
        parent::__construct($message ?? static::MESSAGE);
    }
}
