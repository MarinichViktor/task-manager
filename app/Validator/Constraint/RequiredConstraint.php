<?php


namespace App\Validator\Constraint;

class RequiredConstraint implements ConstraintInterface
{
    public function match($value, array &$errors): bool
    {
        $match = true;
        $validatedValue = $value;

        if (is_string($value)) {
            $validatedValue = trim($value);
        }

        if (empty($validatedValue)) {
            $errors[] = 'Field is required';
            $match = false;
        }

        return $match;
    }
}
