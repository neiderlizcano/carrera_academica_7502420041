<?php
declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidUserPasswordException.php';

final class UserPassword
{
    private string $value;

    public function __construct(string $value)
    {
        if (trim($value) === '') {
            throw InvalidUserPasswordException::becauseValueIsEmpty();
        }

        if (mb_strlen($value) < 8) {
            throw InvalidUserPasswordException::becauseLengthIsTooShort(8);
        }

        $this->value = $value;
    }

    public static function fromPlainText(string $plainText): self
    {
        if (trim($plainText) === '') {
            throw InvalidUserPasswordException::becauseValueIsEmpty();
        }

        if (mb_strlen($plainText) < 8) {
            throw InvalidUserPasswordException::becauseLengthIsTooShort(8);
        }

        return new self(password_hash($plainText, PASSWORD_BCRYPT));
    }

    public static function fromHash(string $hash): self
    {
        return new self($hash);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function verifyPlain(string $plainText): bool
    {
        return password_verify($plainText, $this->value);
    }
}