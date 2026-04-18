<?php
declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidCarreraAcademicaNumCreditosException.php';

final class CarreraAcademicaNumCreditos
{
    public function __construct(
        private int $value
    ) {
        if ($this->value < 0) {
            throw InvalidCarreraAcademicaNumCreditosException::becauseIsInvalid();
        }
    }

    public function value(): int
    {
        return $this->value;
    }
}