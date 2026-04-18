<?php
declare(strict_types=1);

final class InvalidUserEmailException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty(): self
    {
        return new self('El correo electrónico es obligatorio.');
    }

    public static function becauseFormatIsInvalid(string $email): self
    {
        return new self('El correo electrónico no es válido: ' . $email);
    }
}