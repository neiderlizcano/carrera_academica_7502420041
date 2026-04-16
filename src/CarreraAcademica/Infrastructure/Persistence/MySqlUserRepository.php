<?php
declare(strict_types=1);

require_once __DIR__ . '/../../Application/Ports/Out/GetUserByEmailPort.php';
require_once __DIR__ . '/../../Application/Ports/Out/UpdateUserPort.php';

require_once __DIR__ . '/../../Domain/Models/UserModel.php';
require_once __DIR__ . '/../../Domain/ValueObjects/UserId.php';
require_once __DIR__ . '/../../Domain/ValueObjects/UserName.php';
require_once __DIR__ . '/../../Domain/ValueObjects/UserEmail.php';
require_once __DIR__ . '/../../Domain/ValueObjects/UserPassword.php';

final class MySqlUserRepository implements GetUserByEmailPort, UpdateUserPort
{
    private mysqli $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    public function getByEmail(UserEmail $email): ?UserModel
    {
        $sql = "SELECT * FROM users WHERE email = ? LIMIT 1";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            return null;
        }

        $emailValue = $email->value();
        $stmt->bind_param("s", $emailValue);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result ? $result->fetch_assoc() : null;

        $stmt->close();

        if (!$row) {
            return null;
        }

        return new UserModel(
            new UserId((string) $row['id']),
            new UserName((string) $row['name']),
            new UserEmail((string) $row['email']),
            UserPassword::fromHash((string) $row['password']),
            (string) $row['role'],
            (string) $row['status']
        );
    }

    public function update(UserModel $user): UserModel
    {
        $sql = "UPDATE users
                SET name = ?, email = ?, password = ?, role = ?, status = ?, updated_at = NOW()
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new RuntimeException('No fue posible preparar la actualización del usuario.');
        }

        $name = $user->name()->value();
        $email = $user->email()->value();
        $password = $user->password()->value();
        $role = $user->role();
        $status = $user->status();
        $id = $user->id()->value();

        $stmt->bind_param("ssssss", $name, $email, $password, $role, $status, $id);

        if (!$stmt->execute()) {
            $stmt->close();
            throw new RuntimeException('No fue posible actualizar el usuario.');
        }

        $stmt->close();

        return $user;
    }
}