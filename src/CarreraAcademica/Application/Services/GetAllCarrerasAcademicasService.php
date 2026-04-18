<?php
declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/GetAllCarrerasAcademicasUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetAllCarrerasAcademicasPort.php';

final class GetAllCarrerasAcademicasService implements GetAllCarrerasAcademicasUseCase
{
    public function __construct(
        private GetAllCarrerasAcademicasPort $getAllCarrerasAcademicasPort
    ) {
    }

    public function execute(GetAllCarrerasAcademicasQuery $query): array
    {
        return $this->getAllCarrerasAcademicasPort->getAll();
    }
}