<?php
declare(strict_types=1);

final class DeleteCarreraAcademicaCommand
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