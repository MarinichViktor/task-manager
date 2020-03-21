<?php


namespace App\Exception;


class UserNotFoundException extends AppException
{
    protected const MESSAGE = 'User not found';
}
