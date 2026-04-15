<?php
declare(strict_types=1);

require_once __DIR__ . '/../../../../src/CarreraAcademica/Domain/Entity/CarreraAcademica.php';
require_once __DIR__ . '/../../../../src/CarreraAcademica/Application/UseCase/GuardarCarreraAcademicaUseCase.php';
require_once __DIR__ . '/../../../../src/CarreraAcademica/Application/UseCase/ListarCarreraAcademicaUseCase.php';
require_once __DIR__ . '/../../../../src/CarreraAcademica/Application/UseCase/BuscarCarreraAcademicaPorIdUseCase.php';
require_once __DIR__ . '/../../../../src/CarreraAcademica/Application/UseCase/ActualizarCarreraAcademicaUseCase.php';
require_once __DIR__ . '/../../../../src/CarreraAcademica/Application/UseCase/EliminarCarreraAcademicaUseCase.php';

use Src\CarreraAcademica\Domain\Entity\CarreraAcademica;
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

    public function __construct(
        GuardarCarreraAcademicaUseCase $guardarCarreraAcademicaUseCase,
        ListarCarreraAcademicaUseCase $listarCarreraAcademicaUseCase,
        BuscarCarreraAcademicaPorIdUseCase $buscarCarreraAcademicaPorIdUseCase,
        ActualizarCarreraAcademicaUseCase $actualizarCarreraAcademicaUseCase,
        EliminarCarreraAcademicaUseCase $eliminarCarreraAcademicaUseCase
    ) {
        $this->guardarCarreraAcademicaUseCase = $guardarCarreraAcademicaUseCase;
        $this->listarCarreraAcademicaUseCase = $listarCarreraAcademicaUseCase;
        $this->buscarCarreraAcademicaPorIdUseCase = $buscarCarreraAcademicaPorIdUseCase;
        $this->actualizarCarreraAcademicaUseCase = $actualizarCarreraAcademicaUseCase;
        $this->eliminarCarreraAcademicaUseCase = $eliminarCarreraAcademicaUseCase;
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

    public function store(array $form): void
    {
        $carreraAcademica = new CarreraAcademica(
            null,
            $form['nombre'],
            (int) $form['numCreditos'],
            (int) $form['numAsignaturas'],
            (int) $form['numSemestres'],
            $form['nivelFormacion'],
            $form['titulo'],
            (float) $form['valorSemestre'],
            $form['universidad'],
            $form['esAcreditada'],
            $form['perfiles'],
            $form['areaConocimiento']
        );

        $this->guardarCarreraAcademicaUseCase->ejecutar($carreraAcademica);
    }

    public function update(array $form): void
    {
        $carreraAcademica = new CarreraAcademica(
            (int) $form['id'],
            $form['nombre'],
            (int) $form['numCreditos'],
            (int) $form['numAsignaturas'],
            (int) $form['numSemestres'],
            $form['nivelFormacion'],
            $form['titulo'],
            (float) $form['valorSemestre'],
            $form['universidad'],
            $form['esAcreditada'],
            $form['perfiles'],
            $form['areaConocimiento']
        );

        $this->actualizarCarreraAcademicaUseCase->ejecutar($carreraAcademica);
    }

    public function delete(string $id): void
    {
        $this->eliminarCarreraAcademicaUseCase->ejecutar((int) $id);
    }
}