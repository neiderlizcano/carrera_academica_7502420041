<?php
declare(strict_types=1);

final class CreateCarreraAcademicaRequest
{
    public function __construct(
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

    public function nombre(): string { return $this->nombre; }
    public function numCreditos(): string { return $this->numCreditos; }
    public function numAsignaturas(): string { return $this->numAsignaturas; }
    public function numSemestres(): string { return $this->numSemestres; }
    public function nivelFormacion(): string { return $this->nivelFormacion; }
    public function titulo(): string { return $this->titulo; }
    public function valorSemestre(): string { return $this->valorSemestre; }
    public function universidad(): string { return $this->universidad; }
    public function esAcreditada(): string { return $this->esAcreditada; }
    public function perfiles(): string { return $this->perfiles; }
    public function areaConocimiento(): string { return $this->areaConocimiento; }
}