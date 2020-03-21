<?php


namespace App\Exception;


class TaskNotFoundException extends AppException
{
    protected const MESSAGE = 'Task not found';
}
