<?php
declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidCarreraAcademicaIdException.php';

final class CarreraAcademicaId
{
    public function __construct(
        private ?int $value
    ) {
        if ($this->value !== null && $this->value <= 0) {
            throw InvalidCarreraAcademicaIdException::becauseIsInvalid();
        }
    }

    public function value(): ?int
    {
        return $this->value;
    }
}