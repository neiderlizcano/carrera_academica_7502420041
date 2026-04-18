<?php
declare(strict_types=1);

final class UserEntity
{
    public function __construct(
        private string $id,
        private string $name,
        private string $email,
        private string $password,
        private string $role,
        private string $status,
        private string $createdAt,
        private string $updatedAt
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }
}