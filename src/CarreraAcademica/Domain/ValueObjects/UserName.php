<?php
declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidUserNameException.php';

final class UserName
{
    private string $value;

    public function __construct(string $value)
    {
        $value = trim($value);

        if ($value === '') {
            throw InvalidUserNameException::becauseValueIsEmpty();
        }

        if (mb_strlen($value) < 3) {
            throw InvalidUserNameException::becauseLengthIsTooShort(3);
        }

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}