<?php
declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/CarreraAcademicaModel.php';
require_once __DIR__ . '/../Dto/Commands/CreateCarreraAcademicaCommand.php';
require_once __DIR__ . '/../Dto/Commands/UpdateCarreraAcademicaCommand.php';

final class CarreraApplicationMapper
{
    public function fromCreateCommandToModel(CreateCarreraAcademicaCommand $command): CarreraAcademicaModel
    {
        return new CarreraAcademicaModel(
            null,
            $command->getNombre(),
            (int) $command->getNumCreditos(),
            (int) $command->getNumAsignaturas(),
            (int) $command->getNumSemestres(),
            $command->getNivelFormacion(),
            $command->getTitulo(),
            (float) $command->getValorSemestre(),
            $command->getUniversidad(),
            $command->getEsAcreditada(),
            $command->getPerfiles(),
            $command->getAreaConocimiento()
        );
    }

    public function fromUpdateCommandToModel(UpdateCarreraAcademicaCommand $command): CarreraAcademicaModel
    {
        return new CarreraAcademicaModel(
            (int) $command->getId(),
            $command->getNombre(),
            (int) $command->getNumCreditos(),
            (int) $command->getNumAsignaturas(),
            (int) $command->getNumSemestres(),
            $command->getNivelFormacion(),
            $command->getTitulo(),
            (float) $command->getValorSemestre(),
            $command->getUniversidad(),
            $command->getEsAcreditada(),
            $command->getPerfiles(),
            $command->getAreaConocimiento()
        );
    }
}