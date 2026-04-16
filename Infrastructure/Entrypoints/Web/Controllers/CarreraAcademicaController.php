<?php
declare(strict_types=1);

require_once __DIR__ . '/../../../../src/CarreraAcademica/Application/UseCase/GuardarCarreraAcademicaUseCase.php';
require_once __DIR__ . '/../../../../src/CarreraAcademica/Application/UseCase/ListarCarreraAcademicaUseCase.php';
require_once __DIR__ . '/../../../../src/CarreraAcademica/Application/UseCase/BuscarCarreraAcademicaPorIdUseCase.php';
require_once __DIR__ . '/../../../../src/CarreraAcademica/Application/UseCase/ActualizarCarreraAcademicaUseCase.php';
require_once __DIR__ . '/../../../../src/CarreraAcademica/Application/UseCase/EliminarCarreraAcademicaUseCase.php';

require_once __DIR__ . '/Dto/CreateCarreraAcademicaRequest.php';
require_once __DIR__ . '/Dto/UpdateCarreraAcademicaRequest.php';
require_once __DIR__ . '/Mapper/CarreraAcademicaWebMapper.php';

use Src\CarreraAcademica\Application\UseCase\GuardarCarreraAcademicaUseCase;
use Src\CarreraAcademica\Application\UseCase\ListarCarreraAcademicaUseCase;
use Src\CarreraAcademica\Application\UseCase\BuscarCarreraAcademicaPorIdUseCase;
use Src\CarreraAcademica\Application\UseCase\ActualizarCarreraAcademicaUseCase;
use Src\CarreraAcademica\Application\UseCase\EliminarCarreraAcademicaUseCase;

final class CarreraAcademicaController
{
    private GuardarCarreraAcademicaUseCase $guardarCarreraAcademicaUseCase;
    private ListarCarreraAcademicaUseCase $listarCarreraAcademicaUseCase;
    private BuscarCarreraAcademicaPorIdUseCase $buscarCarreraAcademicaPorIdUseCase;
    private ActualizarCarreraAcademicaUseCase $actualizarCarreraAcademicaUseCase;
    private EliminarCarreraAcademicaUseCase $eliminarCarreraAcademicaUseCase;
    private CarreraAcademicaWebMapper $mapper;

    public function __construct(
        GuardarCarreraAcademicaUseCase $guardarCarreraAcademicaUseCase,
        ListarCarreraAcademicaUseCase $listarCarreraAcademicaUseCase,
        BuscarCarreraAcademicaPorIdUseCase $buscarCarreraAcademicaPorIdUseCase,
        ActualizarCarreraAcademicaUseCase $actualizarCarreraAcademicaUseCase,
        EliminarCarreraAcademicaUseCase $eliminarCarreraAcademicaUseCase,
        CarreraAcademicaWebMapper $mapper
    ) {
        $this->guardarCarreraAcademicaUseCase = $guardarCarreraAcademicaUseCase;
        $this->listarCarreraAcademicaUseCase = $listarCarreraAcademicaUseCase;
        $this->buscarCarreraAcademicaPorIdUseCase = $buscarCarreraAcademicaPorIdUseCase;
        $this->actualizarCarreraAcademicaUseCase = $actualizarCarreraAcademicaUseCase;
        $this->eliminarCarreraAcademicaUseCase = $eliminarCarreraAcademicaUseCase;
        $this->mapper = $mapper;
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
        $models = $this->listarCarreraAcademicaUseCase->ejecutar();

        return array(
            'pageTitle' => 'Listado de carreras académicas',
            'message' => Flash::message(),
            'success' => Flash::success(),
            'carreras' => $this->mapper->fromModelsToResponses($models),
        );
    }

    public function show(string $id): array
    {
        $idEntero = (int) $id;
        $model = $this->buscarCarreraAcademicaPorIdUseCase->ejecutar($idEntero);

        if ($idEntero <= 0 || $model === null) {
            throw new RuntimeException('La carrera académica no fue encontrada.');
        }

        return array(
            'pageTitle' => 'Detalle de carrera académica',
            'message' => Flash::message(),
            'success' => Flash::success(),
            'carrera' => $this->mapper->fromModelToResponse($model),
        );
    }

    public function edit(string $id): array
    {
        $idEntero = (int) $id;
        $model = $this->buscarCarreraAcademicaPorIdUseCase->ejecutar($idEntero);

        if ($idEntero <= 0 || $model === null) {
            throw new RuntimeException('La carrera académica no fue encontrada.');
        }

        return array(
            'pageTitle' => 'Editar carrera académica',
            'message' => Flash::message(),
            'success' => Flash::success(),
            'errors' => Flash::errors(),
            'old' => Flash::old(),
            'carrera' => $this->mapper->fromModelToResponse($model),
        );
    }

    public function store(CreateCarreraAcademicaRequest $request): void
    {
        $model = $this->mapper->fromCreateRequestToModel($request);
        $this->guardarCarreraAcademicaUseCase->ejecutar($model);
    }

    public function update(UpdateCarreraAcademicaRequest $request): void
    {
        $model = $this->mapper->fromUpdateRequestToModel($request);
        $this->actualizarCarreraAcademicaUseCase->ejecutar($model);
    }

    public function delete(string $id): void
    {
        $idEntero = (int) $id;

        if ($idEntero <= 0) {
            throw new RuntimeException('El identificador de la carrera académica es inválido.');
        }

        $this->eliminarCarreraAcademicaUseCase->ejecutar($idEntero);
    }
}