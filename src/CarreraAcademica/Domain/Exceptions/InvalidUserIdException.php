<?php
declare(strict_types=1);

final class InvalidUserIdException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty(): self
    {
        return new self('El identificador del usuario es obligatorio.');
    }
}