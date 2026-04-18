<?php
declare(strict_types=1);

final class CarreraAcademicaResponse
{
    public function __construct(
        private int $id,
        private string $nombre,
        private int $numCreditos,
        private int $numAsignaturas,
        private int $numSemestres,
        private string $nivelFormacion,
        private string $titulo,
        private float $valorSemestre,
        private string $universidad,
        private string $esAcreditada,
        private string $perfiles,
        private string $areaConocimiento
    ) {
    }

    public function getId(): int { return $this->id; }
    public function getNombre(): string { return $this->nombre; }
    public function getNumCreditos(): int { return $this->numCreditos; }
    public function getNumAsignaturas(): int { return $this->numAsignaturas; }
    public function getNumSemestres(): int { return $this->numSemestres; }
    public function getNivelFormacion(): string { return $this->nivelFormacion; }
    public function getTitulo(): string { return $this->titulo; }
    public function getValorSemestre(): float { return $this->valorSemestre; }
    public function getUniversidad(): string { return $this->universidad; }
    public function getEsAcreditada(): string { return $this->esAcreditada; }
    public function getPerfiles(): string { return $this->perfiles; }
    public function getAreaConocimiento(): string { return $this->areaConocimiento; }

    public function toArray(): array
    {
        return array(
            'id' => $this->id,
            'nombre' => $this->nombre,
            'numCreditos' => $this->numCreditos,
            'numAsignaturas' => $this->numAsignaturas,
            'numSemestres' => $this->numSemestres,
            'nivelFormacion' => $this->nivelFormacion,
            'titulo' => $this->titulo,
            'valorSemestre' => $this->valorSemestre,
            'universidad' => $this->universidad,
            'esAcreditada' => $this->esAcreditada,
            'perfiles' => $this->perfiles,
            'areaConocimiento' => $this->areaConocimiento,
        );
    }
}