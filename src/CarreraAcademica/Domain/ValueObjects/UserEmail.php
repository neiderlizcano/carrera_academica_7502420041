<?php
declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidUserEmailException.php';

final class UserEmail
{
    private string $value;

    public function __construct(string $value)
    {
        $value = trim(mb_strtolower($value));

        if ($value === '') {
            throw InvalidUserEmailException::becauseValueIsEmpty();
        }

        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw InvalidUserEmailException::becauseFormatIsInvalid($value);
        }

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}