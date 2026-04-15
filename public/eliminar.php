<?php

require_once dirname(__DIR__) . '/src/CarreraAcademica/Domain/Repository/CarreraAcademicaRepository.php';
require_once dirname(__DIR__) . '/src/CarreraAcademica/Application/UseCase/EliminarCarreraAcademicaUseCase.php';
require_once dirname(__DIR__) . '/src/CarreraAcademica/Infrastructure/Persistence/conexion.php';
require_once dirname(__DIR__) . '/src/CarreraAcademica/Infrastructure/Persistence/MySqlCarreraAcademicaRepository.php';

use Src\CarreraAcademica\Application\UseCase\EliminarCarreraAcademicaUseCase;
use Src\CarreraAcademica\Infrastructure\Persistence\MySqlCarreraAcademicaRepository;

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    header('Location: listar.php?mensaje=error');
    exit();
}

$repositorio = new MySqlCarreraAcademicaRepository($conn);
$casoDeUso = new EliminarCarreraAcademicaUseCase($repositorio);

$resultado = $casoDeUso->ejecutar($id);

$conn->close();

if ($resultado) {
    header('Location: listar.php?mensaje=eliminado');
    exit();
}

header('Location: listar.php?mensaje=error');
exit();