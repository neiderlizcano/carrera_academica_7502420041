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
    $sql = "SELECT * FROM carrera_academica ORDER BY id DESC";
    $resultado = $this->conn->query($sql);

    if (!$resultado) {
        return [];
    }

    $carreras = [];

    while ($fila = $resultado->fetch_assoc()) {
        $carreras[] = new CarreraAcademica(
            (int) $fila['id'],
            $fila['nombre'],
            (int) $fila['numCreditos'],
            (int) $fila['numAsignaturas'],
            (int) $fila['numSemestres'],
            $fila['nivelFormacion'],
            $fila['titulo'],
            (float) $fila['valorSemestre'],
            $fila['universidad'],
            $fila['esAcreditada'],
            $fila['perfiles'],
            $fila['areaConocimiento']
        );
    }

    return $carreras;
    }

    public function buscarPorId(int $id): ?CarreraAcademica
    {
    $sql = "SELECT * FROM carrera_academica WHERE id = ?";
    $stmt = $this->conn->prepare($sql);

    if (!$stmt) {
        return null;
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $fila = $resultado->fetch_assoc();

    $stmt->close();

    if (!$fila) {
        return null;
    }

    return new CarreraAcademica(
        (int) $fila['id'],
        $fila['nombre'],
        (int) $fila['numCreditos'],
        (int) $fila['numAsignaturas'],
        (int) $fila['numSemestres'],
        $fila['nivelFormacion'],
        $fila['titulo'],
        (float) $fila['valorSemestre'],
        $fila['universidad'],
        $fila['esAcreditada'],
        $fila['perfiles'],
        $fila['areaConocimiento']
    );
    }

    public function actualizar(CarreraAcademica $carreraAcademica): bool
    {
    $sql = "UPDATE carrera_academica SET
        nombre = ?,
        numCreditos = ?,
        numAsignaturas = ?,
        numSemestres = ?,
        nivelFormacion = ?,
        titulo = ?,
        valorSemestre = ?,
        universidad = ?,
        esAcreditada = ?,
        perfiles = ?,
        areaConocimiento = ?
        WHERE id = ?";

    $stmt = $this->conn->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $id = $carreraAcademica->getId();
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
        "siiissdssssi",
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
        $areaConocimiento,
        $id
    );

    $resultado = $stmt->execute();
    $stmt->close();

    return $resultado;
    }

    public function eliminar(int $id): bool
    {
    $sql = "DELETE FROM carrera_academica WHERE id = ?";
    $stmt = $this->conn->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param("i", $id);
    $resultado = $stmt->execute();
    $stmt->close();

    return $resultado;
    }
}