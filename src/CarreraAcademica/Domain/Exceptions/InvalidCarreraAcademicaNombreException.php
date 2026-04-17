<?php
declare(strict_types=1);

final class InvalidCarreraAcademicaNombreException extends InvalidArgumentException
{
    public static function becauseIsEmpty(): self
    {
        return new self('El nombre de la carrera académica es obligatorio.');
    }
}