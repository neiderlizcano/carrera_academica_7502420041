<?php
declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidUserRoleException.php';

final class UserRoleEnum
{
    public const ADMIN = 'ADMIN';
    public const MEMBER = 'MEMBER';
    public const REVIEWER = 'REVIEWER';

    public static function values(): array
    {
        return array(
            self::ADMIN,
            self::MEMBER,
            self::REVIEWER,
        );
    }

    public static function ensureIsValid(string $value): void
    {
        if (!in_array($value, self::values(), true)) {
            throw InvalidUserRoleException::becauseValueIsInvalid($value);
        }
    }
}