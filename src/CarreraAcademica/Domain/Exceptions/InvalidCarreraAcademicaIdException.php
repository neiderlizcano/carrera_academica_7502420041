<?php
declare(strict_types=1);

final class InvalidCarreraAcademicaIdException extends InvalidArgumentException
{
    public static function becauseIsInvalid(): self
    {
        return new self('El identificador de la carrera académica es inválido.');
    }
}