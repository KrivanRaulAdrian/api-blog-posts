<?php

namespace Api\Validator;

use Api\Exception\InvalidDataException;

class PostValidator
{
    public static function validate(array $data): void
    {
        $errors = [];
        $title = $data['title'] ?? '';
        if (trim($title) === '') {
            $errors[] = 'title should not be empty';
        }
        if (strlen($title) < 3) {
            $errors[] = 'title should not have less than 3 characters';
        }
        if (strlen($title) > 20) {
            $errors[] = 'title should not have over 20 characters';
        }
        $content = $data['content'] ?? '';
        if (trim($content) === '') {
            $errors[] = 'content should not be empty';
        }
        if (strlen($content) < 3) {
            $errors[] = 'content should not have less than 3 characters';
        }
        if (strlen($content) > 225) {
            $errors[] = 'content should not have over 225 characters';
        }
        $thumbnail = $data['thumbnail'] ?? '';
        if (trim($thumbnail) === '') {
            $errors[] = 'thumbnail should not be empty';
        }
        $author = $data['author'] ?? '';
        if (trim($author) === '') {
            $errors[] = 'author should not be empty';
        }
        if (count($errors) > 0) {
            throw InvalidDataException::fromErrors($errors);
        }
    }
}
