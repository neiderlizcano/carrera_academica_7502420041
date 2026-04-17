<?php
declare(strict_types=1);

require_once __DIR__ . '/../Dto/CreateCarreraAcademicaRequest.php';
require_once __DIR__ . '/../Dto/UpdateCarreraAcademicaRequest.php';
require_once __DIR__ . '/../Dto/CarreraAcademicaResponse.php';

require_once __DIR__ . '/../../../../../src/CarreraAcademica/Application/Services/Dto/Commands/CreateCarreraAcademicaCommand.php';
require_once __DIR__ . '/../../../../../src/CarreraAcademica/Application/Services/Dto/Commands/UpdateCarreraAcademicaCommand.php';
require_once __DIR__ . '/../../../../../src/CarreraAcademica/Application/Services/Dto/Commands/DeleteCarreraAcademicaCommand.php';
require_once __DIR__ . '/../../../../../src/CarreraAcademica/Application/Services/Dto/Queries/GetCarreraAcademicaByIdQuery.php';
require_once __DIR__ . '/../../../../../src/CarreraAcademica/Application/Services/Dto/Queries/GetAllCarrerasAcademicasQuery.php';
require_once __DIR__ . '/../../../../../src/CarreraAcademica/Domain/Models/CarreraAcademicaModel.php';

final class CarreraAcademicaWebMapper
{
    public function fromCreateRequestToCommand(CreateCarreraAcademicaRequest $request): CreateCarreraAcademicaCommand
    {
        return new CreateCarreraAcademicaCommand(
            $request->nombre(),
            $request->numCreditos(),
            $request->numAsignaturas(),
            $request->numSemestres(),
            $request->nivelFormacion(),
            $request->titulo(),
            $request->valorSemestre(),
            $request->universidad(),
            $request->esAcreditada(),
            $request->perfiles(),
            $request->areaConocimiento()
        );
    }

    public function fromUpdateRequestToCommand(UpdateCarreraAcademicaRequest $request): UpdateCarreraAcademicaCommand
    {
        return new UpdateCarreraAcademicaCommand(
            $request->id(),
            $request->nombre(),
            $request->numCreditos(),
            $request->numAsignaturas(),
            $request->numSemestres(),
            $request->nivelFormacion(),
            $request->titulo(),
            $request->valorSemestre(),
            $request->universidad(),
            $request->esAcreditada(),
            $request->perfiles(),
            $request->areaConocimiento()
        );
    }

    public function fromIdToDeleteCommand(string $id): DeleteCarreraAcademicaCommand
    {
        return new DeleteCarreraAcademicaCommand($id);
    }

    public function fromIdToGetByIdQuery(string $id): GetCarreraAcademicaByIdQuery
    {
        return new GetCarreraAcademicaByIdQuery($id);
    }

    public function fromNothingToGetAllQuery(): GetAllCarrerasAcademicasQuery
    {
        return new GetAllCarrerasAcademicasQuery();
    }

    public function fromModelToResponse(CarreraAcademicaModel $model): CarreraAcademicaResponse
    {
        return new CarreraAcademicaResponse(
            (int) $model->getId(),
            $model->getNombre(),
            (int) $model->getNumCreditos(),
            (int) $model->getNumAsignaturas(),
            (int) $model->getNumSemestres(),
            $model->getNivelFormacion(),
            $model->getTitulo(),
            (float) $model->getValorSemestre(),
            $model->getUniversidad(),
            $model->getEsAcreditada(),
            $model->getPerfiles(),
            $model->getAreaConocimiento()
        );
    }

    public function fromModelsToResponses(array $models): array
    {
        return array_map(
            fn (CarreraAcademicaModel $model) => $this->fromModelToResponse($model),
            $models
        );
    }
}