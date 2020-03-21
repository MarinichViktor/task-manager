<?php


namespace App\Validator\Constraint;


interface ConstraintInterface
{
    public function match($value, array &$errors): bool;
}
