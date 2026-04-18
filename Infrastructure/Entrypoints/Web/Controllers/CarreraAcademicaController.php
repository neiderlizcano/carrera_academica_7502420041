<?php
declare(strict_types=1);

require_once __DIR__ . '/../../../../src/CarreraAcademica/Application/Ports/In/CreateCarreraAcademicaUseCase.php';
require_once __DIR__ . '/../../../../src/CarreraAcademica/Application/Ports/In/GetAllCarrerasAcademicasUseCase.php';
require_once __DIR__ . '/../../../../src/CarreraAcademica/Application/Ports/In/GetCarreraAcademicaByIdUseCase.php';
require_once __DIR__ . '/../../../../src/CarreraAcademica/Application/Ports/In/UpdateCarreraAcademicaUseCase.php';
require_once __DIR__ . '/../../../../src/CarreraAcademica/Application/Ports/In/DeleteCarreraAcademicaUseCase.php';

require_once __DIR__ . '/Dto/CreateCarreraAcademicaRequest.php';
require_once __DIR__ . '/Dto/UpdateCarreraAcademicaRequest.php';
require_once __DIR__ . '/Mapper/CarreraAcademicaWebMapper.php';

final class CarreraAcademicaController
{
    public function __construct(
        private CreateCarreraAcademicaUseCase $createCarreraAcademicaUseCase,
        private GetAllCarrerasAcademicasUseCase $getAllCarrerasAcademicasUseCase,
        private GetCarreraAcademicaByIdUseCase $getCarreraAcademicaByIdUseCase,
        private UpdateCarreraAcademicaUseCase $updateCarreraAcademicaUseCase,
        private DeleteCarreraAcademicaUseCase $deleteCarreraAcademicaUseCase,
        private CarreraAcademicaWebMapper $mapper
    ) {
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
        $models = $this->getAllCarrerasAcademicasUseCase->execute(
            $this->mapper->fromNothingToGetAllQuery()
        );

        return array(
            'pageTitle' => 'Listado de carreras académicas',
            'message' => Flash::message(),
            'success' => Flash::success(),
            'carreras' => $this->mapper->fromModelsToResponses($models),
        );
    }

    public function show(string $id): array
    {
        $model = $this->getCarreraAcademicaByIdUseCase->execute(
            $this->mapper->fromIdToGetByIdQuery($id)
        );

        return array(
            'pageTitle' => 'Detalle de carrera académica',
            'message' => Flash::message(),
            'success' => Flash::success(),
            'carrera' => $this->mapper->fromModelToResponse($model),
        );
    }

    public function edit(string $id): array
    {
        $model = $this->getCarreraAcademicaByIdUseCase->execute(
            $this->mapper->fromIdToGetByIdQuery($id)
        );

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
        $this->createCarreraAcademicaUseCase->execute(
            $this->mapper->fromCreateRequestToCommand($request)
        );
    }

    public function update(UpdateCarreraAcademicaRequest $request): void
    {
        $this->updateCarreraAcademicaUseCase->execute(
            $this->mapper->fromUpdateRequestToCommand($request)
        );
    }

    public function delete(string $id): void
    {
        $this->deleteCarreraAcademicaUseCase->execute(
            $this->mapper->fromIdToDeleteCommand($id)
        );
    }
}