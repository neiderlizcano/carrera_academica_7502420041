<?php
declare(strict_types=1);

final class InvalidUserNameException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty(): self
    {
        return new self('El nombre del usuario es obligatorio.');
    }

    public static function becauseLengthIsTooShort(int $min): self
    {
        return new self('El nombre del usuario debe tener al menos ' . $min . ' caracteres.');
    }
}