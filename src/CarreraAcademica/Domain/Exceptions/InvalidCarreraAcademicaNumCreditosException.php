<?php
declare(strict_types=1);

final class InvalidCarreraAcademicaNumCreditosException extends InvalidArgumentException
{
    public static function becauseIsInvalid(): self
    {
        return new self('El número de créditos de la carrera académica es inválido.');
    }
}