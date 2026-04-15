<?php

namespace Src\CarreraAcademica\Application\UseCase;

use Src\CarreraAcademica\Domain\Entity\CarreraAcademica;
use Src\CarreraAcademica\Domain\Repository\CarreraAcademicaRepository;

class ActualizarCarreraAcademicaUseCase
{
    private CarreraAcademicaRepository $repositorio;

    public function __construct(CarreraAcademicaRepository $repositorio)
    {
        $this->repositorio = $repositorio;
    }

    public function ejecutar(CarreraAcademica $carreraAcademica): bool
    {
        return $this->repositorio->actualizar($carreraAcademica);
    }
}