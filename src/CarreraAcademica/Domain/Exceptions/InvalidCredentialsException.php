<?php
declare(strict_types=1);

final class InvalidCredentialsException extends DomainException
{
    public static function becauseCredentialsAreInvalid(): self
    {
        return new self('Las credenciales no son válidas.');
    }

    public static function becauseUserIsNotActive(): self
    {
        return new self('Tu cuenta no está activa. Contacta al administrador.');
    }
}