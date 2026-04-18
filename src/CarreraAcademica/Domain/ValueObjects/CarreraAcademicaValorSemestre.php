<?php
declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidCarreraAcademicaValorSemestreException.php';

final class CarreraAcademicaValorSemestre
{
    public function __construct(
        private float $value
    ) {
        if ($this->value < 0) {
            throw InvalidCarreraAcademicaValorSemestreException::becauseIsInvalid();
        }
    }

    public function value(): float
    {
        return $this->value;
    }
}