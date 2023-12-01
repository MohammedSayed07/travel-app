<?php

namespace app\http;

use app\core\Validator;

class FormValidator
{
    protected string $email;
    protected string $password;
    protected array $errors = [];

    public function validate(string $email, string $password): bool
    {
        if (!Validator::isEmail($email)) {
            $this->errors['email'] = '* Email must be valid';
        }

        if (!Validator::string($password, 7, 255)) {
            $this->errors['password'] = '* Password must be more than 7 letters';
        }

        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function error(string $field, string $message): void
    {
        $this->errors[$field] = $message;
    }
}