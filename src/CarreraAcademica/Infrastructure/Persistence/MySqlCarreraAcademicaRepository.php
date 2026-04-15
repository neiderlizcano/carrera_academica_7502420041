<?php

namespace Src\CarreraAcademica\Infrastructure\Persistence;

use Src\CarreraAcademica\Domain\Entity\CarreraAcademica;
use Src\CarreraAcademica\Domain\Repository\CarreraAcademicaRepository;

class MySqlCarreraAcademicaRepository implements CarreraAcademicaRepository
{
    private \mysqli $conn;

    public function __construct(\mysqli $conn)
    {
        $this->conn = $conn;
    }

    public function guardar(CarreraAcademica $carreraAcademica): bool
    {
        $sql = "INSERT INTO carrera_academica 
        (nombre, numCreditos, numAsignaturas, numSemestres, nivelFormacion, titulo, valorSemestre, universidad, esAcreditada, perfiles, areaConocimiento)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            return false;
        }

        $nombre = $carreraAcademica->getNombre();
        $numCreditos = $carreraAcademica->getNumCreditos();
        $numAsignaturas = $carreraAcademica->getNumAsignaturas();
        $numSemestres = $carreraAcademica->getNumSemestres();
        $nivelFormacion = $carreraAcademica->getNivelFormacion();
        $titulo = $carreraAcademica->getTitulo();
        $valorSemestre = $carreraAcademica->getValorSemestre();
        $universidad = $carreraAcademica->getUniversidad();
        $esAcreditada = $carreraAcademica->getEsAcreditada();
        $perfiles = $carreraAcademica->getPerfiles();
        $areaConocimiento = $carreraAcademica->getAreaConocimiento();

        $stmt->bind_param(
            "siiissdssss",
            $nombre,
            $numCreditos,
            $numAsignaturas,
            $numSemestres,
            $nivelFormacion,
            $titulo,
            $valorSemestre,
            $universidad,
            $esAcreditada,
            $perfiles,
            $areaConocimiento
        );

        $resultado = $stmt->execute();
        $stmt->close();

        return $resultado;
    }

    public function listar(): array
    {
        return [];
    }

    public function buscarPorId(int $id): ?CarreraAcademica
    {
        return null;
    }

    public function actualizar(CarreraAcademica $carreraAcademica): bool
    {
        return false;
    }

    public function eliminar(int $id): bool
    {
        return false;
    }
}