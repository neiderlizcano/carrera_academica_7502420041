<?php
declare(strict_types=1);

final class InvalidCarreraAcademicaValorSemestreException extends InvalidArgumentException
{
    public static function becauseIsInvalid(): self
    {
        return new self('El valor del semestre de la carrera académica es inválido.');
    }
}