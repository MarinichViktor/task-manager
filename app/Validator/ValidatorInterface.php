<?php


namespace App\Validator;


use Symfony\Component\HttpFoundation\Request;

interface ValidatorInterface
{
    /**
     * @return array
     */
    public function rules(): array;

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function validate(Request $request, array &$errors): bool;

}
