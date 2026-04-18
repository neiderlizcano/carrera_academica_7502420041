<?php
declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/DeleteCarreraAcademicaCommand.php';

interface DeleteCarreraAcademicaUseCase
{
    public function execute(DeleteCarreraAcademicaCommand $command): void;
}