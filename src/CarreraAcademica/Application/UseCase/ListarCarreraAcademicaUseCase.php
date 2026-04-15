<?php

namespace Src\CarreraAcademica\Application\UseCase;

use Src\CarreraAcademica\Domain\Repository\CarreraAcademicaRepository;

class ListarCarreraAcademicaUseCase
{
    private CarreraAcademicaRepository $repositorio;

    public function __construct(CarreraAcademicaRepository $repositorio)
    {
        $this->repositorio = $repositorio;
    }

    public function ejecutar(): array
    {
        return $this->repositorio->listar();
    }
}