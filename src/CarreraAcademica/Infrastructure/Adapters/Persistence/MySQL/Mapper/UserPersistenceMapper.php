<?php
declare(strict_types=1);

require_once __DIR__ . '/../Dto/UserPersistenceDto.php';
require_once __DIR__ . '/../Entity/UserEntity.php';
require_once __DIR__ . '/../../../../../Domain/Models/UserModel.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/UserId.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/UserName.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/UserEmail.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/UserPassword.php';

final class UserPersistenceMapper
{
    public function fromArrayToDto(array $row): UserPersistenceDto
    {
        return new UserPersistenceDto(
            (string) $row['id'],
            (string) $row['name'],
            (string) $row['email'],
            (string) $row['password'],
            (string) $row['role'],
            (string) $row['status'],
            (string) ($row['created_at'] ?? ''),
            (string) ($row['updated_at'] ?? '')
        );
    }

    public function fromDtoToEntity(UserPersistenceDto $dto): UserEntity
    {
        return new UserEntity(
            $dto->getId(),
            $dto->getName(),
            $dto->getEmail(),
            $dto->getPassword(),
            $dto->getRole(),
            $dto->getStatus(),
            $dto->getCreatedAt(),
            $dto->getUpdatedAt()
        );
    }

    public function fromEntityToModel(UserEntity $entity): UserModel
    {
        return new UserModel(
            new UserId($entity->getId()),
            new UserName($entity->getName()),
            new UserEmail($entity->getEmail()),
            UserPassword::fromHash($entity->getPassword()),
            $entity->getRole(),
            $entity->getStatus()
        );
    }

    public function fromModelToEntity(UserModel $model): UserEntity
    {
        return new UserEntity(
            $model->id()->value(),
            $model->name()->value(),
            $model->email()->value(),
            $model->password()->value(),
            $model->role(),
            $model->status(),
            '',
            ''
        );
    }
}