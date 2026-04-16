<?php
declare(strict_types=1);

require_once __DIR__ . '/../Dto/CreateCarreraAcademicaRequest.php';
require_once __DIR__ . '/../Dto/UpdateCarreraAcademicaRequest.php';
require_once __DIR__ . '/../Dto/CarreraAcademicaResponse.php';

require_once __DIR__ . '/../../../../../src/CarreraAcademica/Domain/Entity/CarreraAcademica.php';

use Src\CarreraAcademica\Domain\Entity\CarreraAcademica;

final class CarreraAcademicaWebMapper
{
    public function fromCreateRequestToModel(CreateCarreraAcademicaRequest $request): CarreraAcademica
    {
        return new CarreraAcademica(
            null,
            $request->nombre(),
            (int) $request->numCreditos(),
            (int) $request->numAsignaturas(),
            (int) $request->numSemestres(),
            $request->nivelFormacion(),
            $request->titulo(),
            (float) $request->valorSemestre(),
            $request->universidad(),
            $request->esAcreditada(),
            $request->perfiles(),
            $request->areaConocimiento()
        );
    }

    public function fromUpdateRequestToModel(UpdateCarreraAcademicaRequest $request): CarreraAcademica
    {
        return new CarreraAcademica(
            (int) $request->id(),
            $request->nombre(),
            (int) $request->numCreditos(),
            (int) $request->numAsignaturas(),
            (int) $request->numSemestres(),
            $request->nivelFormacion(),
            $request->titulo(),
            (float) $request->valorSemestre(),
            $request->universidad(),
            $request->esAcreditada(),
            $request->perfiles(),
            $request->areaConocimiento()
        );
    }

    public function fromModelToResponse(CarreraAcademica $model): CarreraAcademicaResponse
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
            fn (CarreraAcademica $model) => $this->fromModelToResponse($model),
            $models
        );
    }
}