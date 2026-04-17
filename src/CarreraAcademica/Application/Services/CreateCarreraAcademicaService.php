<?php
declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/CreateCarreraAcademicaUseCase.php';
require_once __DIR__ . '/../Ports/Out/SaveCarreraAcademicaPort.php';
require_once __DIR__ . '/Mappers/CarreraApplicationMapper.php';

final class CreateCarreraAcademicaService implements CreateCarreraAcademicaUseCase
{
    public function __construct(
        private SaveCarreraAcademicaPort $saveCarreraAcademicaPort,
        private CarreraApplicationMapper $mapper
    ) {
    }

    public function execute(CreateCarreraAcademicaCommand $command): CarreraAcademicaModel
    {
        $model = $this->mapper->fromCreateCommandToModel($command);

        return $this->saveCarreraAcademicaPort->save($model);
    }
}