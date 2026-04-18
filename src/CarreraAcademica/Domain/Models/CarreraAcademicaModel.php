<?php
declare(strict_types=1);

require_once __DIR__ . '/../ValueObjects/CarreraAcademicaId.php';
require_once __DIR__ . '/../ValueObjects/CarreraAcademicaNombre.php';
require_once __DIR__ . '/../ValueObjects/CarreraAcademicaNumCreditos.php';
require_once __DIR__ . '/../ValueObjects/CarreraAcademicaValorSemestre.php';

final class CarreraAcademicaModel
{
    private CarreraAcademicaId $id;
    private CarreraAcademicaNombre $nombre;
    private CarreraAcademicaNumCreditos $numCreditos;
    private CarreraAcademicaValorSemestre $valorSemestre;

    public function __construct(
        ?int $id,
        string $nombre,
        int $numCreditos,
        private int $numAsignaturas,
        private int $numSemestres,
        private string $nivelFormacion,
        private string $titulo,
        float $valorSemestre,
        private string $universidad,
        private string $esAcreditada,
        private string $perfiles,
        private string $areaConocimiento
    ) {
        $this->id = new CarreraAcademicaId($id);
        $this->nombre = new CarreraAcademicaNombre($nombre);
        $this->numCreditos = new CarreraAcademicaNumCreditos($numCreditos);
        $this->valorSemestre = new CarreraAcademicaValorSemestre($valorSemestre);
    }

    public function getId(): ?int { return $this->id->value(); }
    public function getNombre(): string { return $this->nombre->value(); }
    public function getNumCreditos(): int { return $this->numCreditos->value(); }
    public function getNumAsignaturas(): int { return $this->numAsignaturas; }
    public function getNumSemestres(): int { return $this->numSemestres; }
    public function getNivelFormacion(): string { return $this->nivelFormacion; }
    public function getTitulo(): string { return $this->titulo; }
    public function getValorSemestre(): float { return $this->valorSemestre->value(); }
    public function getUniversidad(): string { return $this->universidad; }
    public function getEsAcreditada(): string { return $this->esAcreditada; }
    public function getPerfiles(): string { return $this->perfiles; }
    public function getAreaConocimiento(): string { return $this->areaConocimiento; }
}