<?php
declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Queries/GetAllCarrerasAcademicasQuery.php';
require_once __DIR__ . '/../../../Domain/Models/CarreraAcademicaModel.php';

interface GetAllCarrerasAcademicasUseCase
{
    /** @return CarreraAcademicaModel[] */
    public function execute(GetAllCarrerasAcademicasQuery $query): array;
}