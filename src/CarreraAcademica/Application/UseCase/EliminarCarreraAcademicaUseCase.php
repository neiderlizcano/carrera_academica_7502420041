<?php

namespace Src\CarreraAcademica\Application\UseCase;

use Src\CarreraAcademica\Domain\Repository\CarreraAcademicaRepository;

class EliminarCarreraAcademicaUseCase
{
    private CarreraAcademicaRepository $repositorio;

    public function __construct(CarreraAcademicaRepository $repositorio)
    {
        $this->repositorio = $repositorio;
    }

    public function ejecutar(int $id): bool
    {
        return $this->repositorio->eliminar($id);
    }
}