<?php
declare(strict_types=1);

final class UpdateCarreraAcademicaCommand
{
    public function __construct(
        private string $id,
        private string $nombre,
        private string $numCreditos,
        private string $numAsignaturas,
        private string $numSemestres,
        private string $nivelFormacion,
        private string $titulo,
        private string $valorSemestre,
        private string $universidad,
        private string $esAcreditada,
        private string $perfiles,
        private string $areaConocimiento
    ) {
    }

    public function getId(): string { return trim($this->id); }
    public function getNombre(): string { return trim($this->nombre); }
    public function getNumCreditos(): string { return trim($this->numCreditos); }
    public function getNumAsignaturas(): string { return trim($this->numAsignaturas); }
    public function getNumSemestres(): string { return trim($this->numSemestres); }
    public function getNivelFormacion(): string { return trim($this->nivelFormacion); }
    public function getTitulo(): string { return trim($this->titulo); }
    public function getValorSemestre(): string { return trim($this->valorSemestre); }
    public function getUniversidad(): string { return trim($this->universidad); }
    public function getEsAcreditada(): string { return trim($this->esAcreditada); }
    public function getPerfiles(): string { return trim($this->perfiles); }
    public function getAreaConocimiento(): string { return trim($this->areaConocimiento); }
}