<?php
declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/CreateCarreraAcademicaCommand.php';
require_once __DIR__ . '/../../../Domain/Models/CarreraAcademicaModel.php';

interface CreateCarreraAcademicaUseCase
{
    public function execute(CreateCarreraAcademicaCommand $command): CarreraAcademicaModel;
}