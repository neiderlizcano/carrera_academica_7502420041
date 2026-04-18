<?php
declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Queries/GetCarreraAcademicaByIdQuery.php';
require_once __DIR__ . '/../../../Domain/Models/CarreraAcademicaModel.php';

interface GetCarreraAcademicaByIdUseCase
{
    public function execute(GetCarreraAcademicaByIdQuery $query): CarreraAcademicaModel;
}