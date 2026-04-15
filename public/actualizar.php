<?php

require_once dirname(__DIR__) . '/src/CarreraAcademica/Domain/Entity/CarreraAcademica.php';
require_once dirname(__DIR__) . '/src/CarreraAcademica/Domain/Repository/CarreraAcademicaRepository.php';
require_once dirname(__DIR__) . '/src/CarreraAcademica/Application/UseCase/ActualizarCarreraAcademicaUseCase.php';
require_once dirname(__DIR__) . '/src/CarreraAcademica/Infrastructure/Persistence/conexion.php';
require_once dirname(__DIR__) . '/src/CarreraAcademica/Infrastructure/Persistence/MySqlCarreraAcademicaRepository.php';

use Src\CarreraAcademica\Domain\Entity\CarreraAcademica;
use Src\CarreraAcademica\Application\UseCase\ActualizarCarreraAcademicaUseCase;
use Src\CarreraAcademica\Infrastructure\Persistence\MySqlCarreraAcademicaRepository;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: listar.php?mensaje=error');
    exit();
}

$id = (int) ($_POST['id'] ?? 0);
$nombre = trim($_POST['nombre'] ?? '');
$numCreditos = trim($_POST['numCreditos'] ?? '');
$numAsignaturas = trim($_POST['numAsignaturas'] ?? '');
$numSemestres = trim($_POST['numSemestres'] ?? '');
$nivelFormacion = trim($_POST['nivelFormacion'] ?? '');
$titulo = trim($_POST['titulo'] ?? '');
$valorSemestre = trim($_POST['valorSemestre'] ?? '');
$universidad = trim($_POST['universidad'] ?? '');
$esAcreditada = trim($_POST['esAcreditada'] ?? '');
$perfiles = trim($_POST['perfiles'] ?? '');
$areaConocimiento = trim($_POST['areaConocimiento'] ?? '');

if (
    $id <= 0 ||
    $nombre === '' ||
    $numCreditos === '' ||
    $numAsignaturas === '' ||
    $numSemestres === '' ||
    $nivelFormacion === '' ||
    $titulo === '' ||
    $valorSemestre === '' ||
    $universidad === '' ||
    $esAcreditada === '' ||
    $perfiles === '' ||
    $areaConocimiento === ''
) {
    header('Location: listar.php?mensaje=error');
    exit();
}

$carreraAcademica = new CarreraAcademica(
    $id,
    $nombre,
    (int) $numCreditos,
    (int) $numAsignaturas,
    (int) $numSemestres,
    $nivelFormacion,
    $titulo,
    (float) $valorSemestre,
    $universidad,
    $esAcreditada,
    $perfiles,
    $areaConocimiento
);

$repositorio = new MySqlCarreraAcademicaRepository($conn);
$casoDeUso = new ActualizarCarreraAcademicaUseCase($repositorio);

$resultado = $casoDeUso->ejecutar($carreraAcademica);

$conn->close();

if ($resultado) {
    header('Location: listar.php?mensaje=actualizado');
    exit();
}

header('Location: listar.php?mensaje=error');
exit();