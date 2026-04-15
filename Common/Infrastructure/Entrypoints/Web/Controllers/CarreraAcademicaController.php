<?php
declare(strict_types=1);

require_once __DIR__ . '/../../../../src/CarreraAcademica/Application/UseCase/ListarCarreraAcademicaUseCase.php';
require_once __DIR__ . '/../../../../src/CarreraAcademica/Application/UseCase/BuscarCarreraAcademicaPorIdUseCase.php';

use Src\CarreraAcademica\Application\UseCase\ListarCarreraAcademicaUseCase;
use Src\CarreraAcademica\Application\UseCase\BuscarCarreraAcademicaPorIdUseCase;

final class CarreraAcademicaController
{
    private ListarCarreraAcademicaUseCase $listarCarreraAcademicaUseCase;
    private BuscarCarreraAcademicaPorIdUseCase $buscarCarreraAcademicaPorIdUseCase;

    public function __construct(
        ListarCarreraAcademicaUseCase $listarCarreraAcademicaUseCase,
        BuscarCarreraAcademicaPorIdUseCase $buscarCarreraAcademicaPorIdUseCase
    ) {
        $this->listarCarreraAcademicaUseCase = $listarCarreraAcademicaUseCase;
        $this->buscarCarreraAcademicaPorIdUseCase = $buscarCarreraAcademicaPorIdUseCase;
    }

    public function home(): array
    {
        return array(
            'pageTitle' => 'Inicio',
            'message' => Flash::message(),
            'success' => Flash::success(),
        );
    }

    public function create(): array
    {
        return array(
            'pageTitle' => 'Registrar carrera académica',
            'message' => Flash::message(),
            'success' => Flash::success(),
            'errors' => Flash::errors(),
            'old' => Flash::old(),
        );
    }

    public function index(): array
    {
        return array(
            'pageTitle' => 'Listado de carreras académicas',
            'message' => Flash::message(),
            'success' => Flash::success(),
            'carreras' => $this->listarCarreraAcademicaUseCase->ejecutar(),
        );
    }

    public function edit(string $id): array
    {
        $idEntero = (int) $id;
        $carrera = $this->buscarCarreraAcademicaPorIdUseCase->ejecutar($idEntero);

        if ($idEntero <= 0 || $carrera === null) {
            throw new RuntimeException('La carrera académica no fue encontrada.');
        }

        return array(
            'pageTitle' => 'Editar carrera académica',
            'message' => Flash::message(),
            'success' => Flash::success(),
            'errors' => Flash::errors(),
            'old' => Flash::old(),
            'carrera' => $carrera,
        );
    }
}