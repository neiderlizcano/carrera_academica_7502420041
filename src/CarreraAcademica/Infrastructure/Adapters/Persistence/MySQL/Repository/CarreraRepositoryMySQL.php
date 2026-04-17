<?php
declare(strict_types=1);

require_once __DIR__ . '/../Config/Connection.php';
require_once __DIR__ . '/../Mapper/CarreraPersistenceMapper.php';
require_once __DIR__ . '/../../../../../Domain/Repository/CarreraAcademicaRepository.php';
require_once __DIR__ . '/../../../../../Domain/Entity/CarreraAcademica.php';

use Src\CarreraAcademica\Domain\Entity\CarreraAcademica;
use Src\CarreraAcademica\Domain\Repository\CarreraAcademicaRepository;

final class CarreraRepositoryMySQL implements CarreraAcademicaRepository
{
    private mysqli $conn;
    private CarreraPersistenceMapper $mapper;

    public function __construct()
    {
        $this->conn = Connection::get();
        $this->mapper = new CarreraPersistenceMapper();
    }

    public function guardar(CarreraAcademica $carreraAcademica): bool
    {
        $entity = $this->mapper->fromModelToEntity($carreraAcademica);

        $sql = 'INSERT INTO carrera_academica
                (nombre, numCreditos, numAsignaturas, numSemestres, nivelFormacion, titulo, valorSemestre, universidad, esAcreditada, perfiles, areaConocimiento)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new RuntimeException('No fue posible preparar el guardado de la carrera.');
        }

        $nombre = $entity->getNombre();
        $numCreditos = $entity->getNumCreditos();
        $numAsignaturas = $entity->getNumAsignaturas();
        $numSemestres = $entity->getNumSemestres();
        $nivelFormacion = $entity->getNivelFormacion();
        $titulo = $entity->getTitulo();
        $valorSemestre = $entity->getValorSemestre();
        $universidad = $entity->getUniversidad();
        $esAcreditada = $entity->getEsAcreditada();
        $perfiles = $entity->getPerfiles();
        $areaConocimiento = $entity->getAreaConocimiento();

        $stmt->bind_param(
            'siiissdssss',
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

        $ok = $stmt->execute();
        $stmt->close();

        if (!$ok) {
            throw new RuntimeException('No fue posible guardar la carrera.');
        }

        return true;
    }

    public function listar(): array
    {
        $sql = 'SELECT * FROM carrera_academica ORDER BY id DESC';
        $result = $this->conn->query($sql);

        if (!$result) {
            return array();
        }

        $carreras = array();

        while ($row = $result->fetch_assoc()) {
            $dto = $this->mapper->fromArrayToDto($row);
            $entity = $this->mapper->fromDtoToEntity($dto);
            $carreras[] = $this->mapper->fromEntityToModel($entity);
        }

        return $carreras;
    }

    public function buscarPorId(int $id): ?CarreraAcademica
    {
        $sql = 'SELECT * FROM carrera_academica WHERE id = ? LIMIT 1';
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            return null;
        }

        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result ? $result->fetch_assoc() : null;

        $stmt->close();

        if (!$row) {
            return null;
        }

        $dto = $this->mapper->fromArrayToDto($row);
        $entity = $this->mapper->fromDtoToEntity($dto);

        return $this->mapper->fromEntityToModel($entity);
    }

    public function actualizar(CarreraAcademica $carreraAcademica): bool
    {
        $entity = $this->mapper->fromModelToEntity($carreraAcademica);

        $sql = 'UPDATE carrera_academica
                SET nombre = ?, numCreditos = ?, numAsignaturas = ?, numSemestres = ?, nivelFormacion = ?, titulo = ?, valorSemestre = ?, universidad = ?, esAcreditada = ?, perfiles = ?, areaConocimiento = ?
                WHERE id = ?';

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new RuntimeException('No fue posible preparar la actualización de la carrera.');
        }

        $nombre = $entity->getNombre();
        $numCreditos = $entity->getNumCreditos();
        $numAsignaturas = $entity->getNumAsignaturas();
        $numSemestres = $entity->getNumSemestres();
        $nivelFormacion = $entity->getNivelFormacion();
        $titulo = $entity->getTitulo();
        $valorSemestre = $entity->getValorSemestre();
        $universidad = $entity->getUniversidad();
        $esAcreditada = $entity->getEsAcreditada();
        $perfiles = $entity->getPerfiles();
        $areaConocimiento = $entity->getAreaConocimiento();
        $id = $entity->getId();

        $stmt->bind_param(
            'siiissdssssi',
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

        $ok = $stmt->execute();
        $stmt->close();

        if (!$ok) {
            throw new RuntimeException('No fue posible actualizar la carrera.');
        }

        return true;
    }

    public function eliminar(int $id): bool
    {
        $sql = 'DELETE FROM carrera_academica WHERE id = ?';
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new RuntimeException('No fue posible preparar la eliminación de la carrera.');
        }

        $stmt->bind_param('i', $id);

        $ok = $stmt->execute();
        $stmt->close();

        if (!$ok) {
            throw new RuntimeException('No fue posible eliminar la carrera.');
        }

        return true;
    }
}