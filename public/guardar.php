<?php

require_once dirname(__DIR__) . '/src/CarreraAcademica/Domain/Entity/CarreraAcademica.php';
require_once dirname(__DIR__) . '/src/CarreraAcademica/Domain/Repository/CarreraAcademicaRepository.php';
require_once dirname(__DIR__) . '/src/CarreraAcademica/Application/UseCase/GuardarCarreraAcademicaUseCase.php';
require_once dirname(__DIR__) . '/src/CarreraAcademica/Infrastructure/Persistence/conexion.php';
require_once dirname(__DIR__) . '/src/CarreraAcademica/Infrastructure/Persistence/MySqlCarreraAcademicaRepository.php';

use Src\CarreraAcademica\Domain\Entity\CarreraAcademica;
use Src\CarreraAcademica\Application\UseCase\GuardarCarreraAcademicaUseCase;
use Src\CarreraAcademica\Infrastructure\Persistence\MySqlCarreraAcademicaRepository;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit();
}

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
    header('Location: index.php?mensaje=vacio');
    exit();
}

$carreraAcademica = new CarreraAcademica(
    null,
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
$casoDeUso = new GuardarCarreraAcademicaUseCase($repositorio);

$resultado = $casoDeUso->ejecutar($carreraAcademica);

$conn->close();

if ($resultado) {
    header('Location: index.php?mensaje=ok');
    exit();
}

header('Location: index.php?mensaje=error');
exit();