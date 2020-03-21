<?php

namespace App\Validator;


use App\Validator\Constraint\ConstraintInterface;
use App\Validator\Constraint\RequiredConstraint;
use Symfony\Component\HttpFoundation\Request;

class AuthenticationValidator implements ValidatorInterface
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => [new RequiredConstraint()],
            'password' => [new RequiredConstraint()]
        ];
    }

    /**
     * @inheritDoc
     */
    public function validate(Request $request, array &$errors): bool
    {
        $errors = [];
        $isValid = true;

        foreach ($this->rules() as $name => $constraints) {
            $fieldErrors = [];
            /** @var ConstraintInterface $constraint */
            foreach ($constraints as $constraint) {
                $constraint->match($request->get($name), $fieldErrors);
            }

            if (count($fieldErrors) > 0) {
                $isValid = false;
                $errors[$name]['messages'] = $fieldErrors;
            }

            $errors[$name]['oldValue'] = $request->get($name);
        }

        return $isValid;
    }
}
