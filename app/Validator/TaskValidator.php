<?php

namespace App\Validator;


use Symfony\Component\HttpFoundation\Request;

class TaskValidator implements ValidatorInterface
{
    /**
     * @inheritDoc
     */
    public function validate(Request $request)
    {
        $errors = [];

        if (null == $request->get('name')) {
            $errors['name'] = [
               'message' => 'Author name is required',
                'value' => $request->get('name')
            ];
        }

        if (null == $request->get('email')) {
            $errors['email'] = [
                'message' => 'Author email is required',
                'value' => $request->get('email')
            ];
        }

        if (null == $request->get('description')) {
            $errors['description'] = [
                'message' => 'Description is required',
                'value' => $request->get('description')
            ];
        }

        return count($errors) > 0 ? $errors : null;
    }
}
