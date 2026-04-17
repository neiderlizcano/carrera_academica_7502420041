<?php
declare(strict_types=1);

require_once __DIR__ . '/../Dto/CarreraPersistenceDto.php';
require_once __DIR__ . '/../Entity/CarreraEntity.php';
require_once __DIR__ . '/../../../../../Domain/Entity/CarreraAcademica.php';

use Src\CarreraAcademica\Domain\Entity\CarreraAcademica;

final class CarreraPersistenceMapper
{
    public function fromArrayToDto(array $row): CarreraPersistenceDto
    {
        return new CarreraPersistenceDto(
            isset($row['id']) ? (int) $row['id'] : null,
            (string) $row['nombre'],
            (int) $row['numCreditos'],
            (int) $row['numAsignaturas'],
            (int) $row['numSemestres'],
            (string) $row['nivelFormacion'],
            (string) $row['titulo'],
            (float) $row['valorSemestre'],
            (string) $row['universidad'],
            (string) $row['esAcreditada'],
            (string) $row['perfiles'],
            (string) $row['areaConocimiento']
        );
    }

    public function fromDtoToEntity(CarreraPersistenceDto $dto): CarreraEntity
    {
        return new CarreraEntity(
            $dto->getId(),
            $dto->getNombre(),
            $dto->getNumCreditos(),
            $dto->getNumAsignaturas(),
            $dto->getNumSemestres(),
            $dto->getNivelFormacion(),
            $dto->getTitulo(),
            $dto->getValorSemestre(),
            $dto->getUniversidad(),
            $dto->getEsAcreditada(),
            $dto->getPerfiles(),
            $dto->getAreaConocimiento()
        );
    }

    public function fromEntityToModel(CarreraEntity $entity): CarreraAcademica
    {
        return new CarreraAcademica(
            $entity->getId(),
            $entity->getNombre(),
            $entity->getNumCreditos(),
            $entity->getNumAsignaturas(),
            $entity->getNumSemestres(),
            $entity->getNivelFormacion(),
            $entity->getTitulo(),
            $entity->getValorSemestre(),
            $entity->getUniversidad(),
            $entity->getEsAcreditada(),
            $entity->getPerfiles(),
            $entity->getAreaConocimiento()
        );
    }

    public function fromModelToEntity(CarreraAcademica $model): CarreraEntity
    {
        return new CarreraEntity(
            $model->getId(),
            $model->getNombre(),
            $model->getNumCreditos(),
            $model->getNumAsignaturas(),
            $model->getNumSemestres(),
            $model->getNivelFormacion(),
            $model->getTitulo(),
            $model->getValorSemestre(),
            $model->getUniversidad(),
            $model->getEsAcreditada(),
            $model->getPerfiles(),
            $model->getAreaConocimiento()
        );
    }
}