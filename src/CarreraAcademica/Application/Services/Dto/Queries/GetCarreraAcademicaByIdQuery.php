<?php
declare(strict_types=1);

final class GetCarreraAcademicaByIdQuery
{
    public function __construct(
        private string $id
    ) {
    }

    public function getId(): string
    {
        return trim($this->id);
    }
}