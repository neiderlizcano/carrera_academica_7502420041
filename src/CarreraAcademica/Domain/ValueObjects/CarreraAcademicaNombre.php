<?php
declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidCarreraAcademicaNombreException.php';

final class CarreraAcademicaNombre
{
    private string $value;

    public function __construct(string $value)
    {
        $value = trim($value);

        if ($value === '') {
            throw InvalidCarreraAcademicaNombreException::becauseIsEmpty();
        }

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}