<?php
declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidUserStatusException.php';

final class UserStatusEnum
{
    public const ACTIVE = 'ACTIVE';
    public const INACTIVE = 'INACTIVE';
    public const PENDING = 'PENDING';
    public const BLOCKED = 'BLOCKED';

    public static function values(): array
    {
        return array(
            self::ACTIVE,
            self::INACTIVE,
            self::PENDING,
            self::BLOCKED,
        );
    }

    public static function ensureIsValid(string $value): void
    {
        if (!in_array($value, self::values(), true)) {
            throw InvalidUserStatusException::becauseValueIsInvalid($value);
        }
    }
}