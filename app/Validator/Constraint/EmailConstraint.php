<?php


namespace App\Validator\Constraint;


class EmailConstraint implements ConstraintInterface
{
    public function match($value, array &$errors): bool
    {
        $match = true;

        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Field is not valid email address';
            $match = false;
        }

        return $match;
    }
}
