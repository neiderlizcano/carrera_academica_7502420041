<?php
declare(strict_types=1);

final class ForgotPasswordWebRequest
{
    public function __construct(
        private string $email
    ) {
    }

    public function email(): string
    {
        return $this->email;
    }
}