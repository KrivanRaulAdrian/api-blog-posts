<?php

namespace Api\Validator;

use Api\Exception\InvalidDataException;

class CategoryValidator
{
    public static function validate(array $data): void
    {
        $errors = [];
        $name = $data['name'] ?? '';
        if (trim($name) === '') {
            $errors[] = 'name should not be empty';
        }
        if (strlen($name) < 3) {
            $errors[] = 'name should not have less than 3 characters';
        }
        if (strlen($name) > 20) {
            $errors[] = 'name should not have over 20 characters';
        }
        $description = $data['description'] ?? '';
        if (trim($description) === '') {
            $errors[] = 'description should not be empty';
        }
        if (strlen($description) < 3) {
            $errors[] = 'description should not have less than 3 characters';
        }
        if (strlen($description) > 50) {
            $errors[] = 'description should not have over 20 characters';
        }
        if (count($errors) > 0) {
            throw InvalidDataException::fromErrors($errors);
        }
    }
}
