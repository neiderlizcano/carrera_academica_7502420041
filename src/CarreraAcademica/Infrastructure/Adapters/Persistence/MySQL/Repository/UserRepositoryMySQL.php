<?php
declare(strict_types=1);

require_once __DIR__ . '/../Config/Connection.php';
require_once __DIR__ . '/../Mapper/UserPersistenceMapper.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/GetUserByEmailPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/UpdateUserPort.php';

final class UserRepositoryMySQL implements GetUserByEmailPort, UpdateUserPort
{
    private mysqli $conn;
    private UserPersistenceMapper $mapper;

    public function __construct()
    {
        $this->conn = Connection::get();
        $this->mapper = new UserPersistenceMapper();
    }

    public function getByEmail(UserEmail $email): ?UserModel
    {
        $sql = 'SELECT * FROM users WHERE email = ? LIMIT 1';
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            return null;
        }

        $emailValue = $email->value();
        $stmt->bind_param('s', $emailValue);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result ? $result->fetch_assoc() : null;

        $stmt->close();

        if (!$row) {
            return null;
        }

        $dto = $this->mapper->fromArrayToDto($row);
        $entity = $this->mapper->fromDtoToEntity($dto);

        return $this->mapper->fromEntityToModel($entity);
    }

    public function update(UserModel $user): UserModel
    {
        $entity = $this->mapper->fromModelToEntity($user);

        $sql = 'UPDATE users
                SET name = ?, email = ?, password = ?, role = ?, status = ?, updated_at = NOW()
                WHERE id = ?';

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new RuntimeException('No fue posible preparar la actualización del usuario.');
        }

        $name = $entity->getName();
        $email = $entity->getEmail();
        $password = $entity->getPassword();
        $role = $entity->getRole();
        $status = $entity->getStatus();
        $id = $entity->getId();

        $stmt->bind_param('ssssss', $name, $email, $password, $role, $status, $id);

        if (!$stmt->execute()) {
            $stmt->close();
            throw new RuntimeException('No fue posible actualizar el usuario.');
        }

        $stmt->close();

        return $user;
    }
}