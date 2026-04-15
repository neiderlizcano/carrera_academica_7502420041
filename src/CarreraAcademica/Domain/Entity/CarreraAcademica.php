<?php

namespace Src\CarreraAcademica\Domain\Entity;

class CarreraAcademica
{
    private ?int $id;
    private string $nombre;
    private int $numCreditos;
    private int $numAsignaturas;
    private int $numSemestres;
    private string $nivelFormacion;
    private string $titulo;
    private float $valorSemestre;
    private string $universidad;
    private string $esAcreditada;
    private string $perfiles;
    private string $areaConocimiento;

    public function __construct(
        ?int $id,
        string $nombre,
        int $numCreditos,
        int $numAsignaturas,
        int $numSemestres,
        string $nivelFormacion,
        string $titulo,
        float $valorSemestre,
        string $universidad,
        string $esAcreditada,
        string $perfiles,
        string $areaConocimiento
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->numCreditos = $numCreditos;
        $this->numAsignaturas = $numAsignaturas;
        $this->numSemestres = $numSemestres;
        $this->nivelFormacion = $nivelFormacion;
        $this->titulo = $titulo;
        $this->valorSemestre = $valorSemestre;
        $this->universidad = $universidad;
        $this->esAcreditada = $esAcreditada;
        $this->perfiles = $perfiles;
        $this->areaConocimiento = $areaConocimiento;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getNumCreditos(): int
    {
        return $this->numCreditos;
    }

    public function getNumAsignaturas(): int
    {
        return $this->numAsignaturas;
    }

    public function getNumSemestres(): int
    {
        return $this->numSemestres;
    }

    public function getNivelFormacion(): string
    {
        return $this->nivelFormacion;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function getValorSemestre(): float
    {
        return $this->valorSemestre;
    }

    public function getUniversidad(): string
    {
        return $this->universidad;
    }

    public function getEsAcreditada(): string
    {
        return $this->esAcreditada;
    }

    public function getPerfiles(): string
    {
        return $this->perfiles;
    }

    public function getAreaConocimiento(): string
    {
        return $this->areaConocimiento;
    }
}