<?php
declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/CarreraAcademicaModel.php';

interface GetAllCarrerasAcademicasPort
{
    /** @return CarreraAcademicaModel[] */
    public function getAll(): array;
}