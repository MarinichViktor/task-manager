<?php


namespace App\Exception;


use Throwable;

class AppException extends \Exception
{
    protected const MESSAGE = 'Application exception occurred';

    public function __construct($message = null, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message ?? static::MESSAGE, $code, $previous);
    }
}
