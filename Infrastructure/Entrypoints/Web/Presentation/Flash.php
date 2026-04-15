<?php
declare(strict_types=1);

final class Flash
{
    public static function start(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (!isset($_SESSION['_flash'])) {
            $_SESSION['_flash'] = array();
        }
    }

    public static function set(string $key, mixed $value): void
    {
        $_SESSION['_flash'][$key] = $value;
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        if (!isset($_SESSION['_flash'][$key])) {
            return $default;
        }

        $value = $_SESSION['_flash'][$key];
        unset($_SESSION['_flash'][$key]);

        return $value;
    }

    public static function setOld(array $form): void
    {
        self::set('old', $form);
    }

    public static function old(): array
    {
        return (array) self::get('old', array());
    }

    public static function setErrors(array $errors): void
    {
        self::set('errors', $errors);
    }

    public static function errors(): array
    {
        return (array) self::get('errors', array());
    }

    public static function setMessage(string $message): void
    {
        self::set('message', $message);
    }

    public static function message(): ?string
    {
        $message = self::get('message');

        return $message === null ? null : (string) $message;
    }

    public static function setSuccess(string $message): void
    {
        self::set('success', $message);
    }

    public static function success(): ?string
    {
        $message = self::get('success');

        return $message === null ? null : (string) $message;
    }
}