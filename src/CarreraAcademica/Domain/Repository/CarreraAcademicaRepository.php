<?php

namespace Src\CarreraAcademica\Domain\Repository;

use Src\CarreraAcademica\Domain\Entity\CarreraAcademica;

interface CarreraAcademicaRepository
{
    public function guardar(CarreraAcademica $carreraAcademica): bool;

    public function listar(): array;

    public function buscarPorId(int $id): ?CarreraAcademica;

    public function actualizar(CarreraAcademica $carreraAcademica): bool;

    public function eliminar(int $id): bool;
}