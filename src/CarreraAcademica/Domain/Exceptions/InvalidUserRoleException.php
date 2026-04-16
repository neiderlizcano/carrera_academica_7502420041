<?php
declare(strict_types=1);

final class InvalidUserRoleException extends DomainException
{
    public static function becauseValueIsInvalid(string $value): self
    {
        return new self('El rol del usuario no es válido: ' . $value);
    }
}