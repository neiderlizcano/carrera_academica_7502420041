<?php
declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidUserIdException.php';

final class UserId
{
    private string $value;

    public function __construct(string $value)
    {
        $value = trim($value);

        if ($value === '') {
            throw InvalidUserIdException::becauseValueIsEmpty();
        }

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}