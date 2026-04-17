<?php
declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/UpdateCarreraAcademicaUseCase.php';
require_once __DIR__ . '/../Ports/Out/UpdateCarreraAcademicaPort.php';
require_once __DIR__ . '/Mappers/CarreraApplicationMapper.php';

final class UpdateCarreraAcademicaService implements UpdateCarreraAcademicaUseCase
{
    public function __construct(
        private UpdateCarreraAcademicaPort $updateCarreraAcademicaPort,
        private CarreraApplicationMapper $mapper
    ) {
    }

    public function execute(UpdateCarreraAcademicaCommand $command): CarreraAcademicaModel
    {
        $model = $this->mapper->fromUpdateCommandToModel($command);

        return $this->updateCarreraAcademicaPort->update($model);
    }
}