<?php
declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/GetCarreraAcademicaByIdUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetCarreraAcademicaByIdPort.php';

final class GetCarreraAcademicaByIdService implements GetCarreraAcademicaByIdUseCase
{
    public function __construct(
        private GetCarreraAcademicaByIdPort $getCarreraAcademicaByIdPort
    ) {
    }

    public function execute(GetCarreraAcademicaByIdQuery $query): CarreraAcademicaModel
    {
        $model = $this->getCarreraAcademicaByIdPort->getById((int) $query->getId());

        if ($model === null) {
            throw new RuntimeException('La carrera académica no fue encontrada.');
        }

        return $model;
    }
}