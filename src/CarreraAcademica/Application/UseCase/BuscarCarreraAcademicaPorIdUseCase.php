<?php

namespace Src\CarreraAcademica\Application\UseCase;

use Src\CarreraAcademica\Domain\Entity\CarreraAcademica;
use Src\CarreraAcademica\Domain\Repository\CarreraAcademicaRepository;

class BuscarCarreraAcademicaPorIdUseCase
{
    private CarreraAcademicaRepository $repositorio;

    public function __construct(CarreraAcademicaRepository $repositorio)
    {
        $this->repositorio = $repositorio;
    }

    public function ejecutar(int $id): ?CarreraAcademica
    {
        return $this->repositorio->buscarPorId($id);
    }
}