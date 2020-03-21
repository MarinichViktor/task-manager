<?php


namespace App\Validator;


use Symfony\Component\HttpFoundation\Request;

interface ValidatorInterface
{
    public const EMAIL_FORMAT = '\A[a-z0-9!#$%&\'*+/=?^_‘{|}~-]+(?:\.[a-z0-9!#$%&\'*+/=?^_‘{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\z';

    /**
     * @param Request $request
     *
     * @return null | array
     */
    public function validate(Request $request);
}
