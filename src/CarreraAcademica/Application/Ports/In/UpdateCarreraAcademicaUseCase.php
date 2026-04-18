<?php
declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/UpdateCarreraAcademicaCommand.php';
require_once __DIR__ . '/../../../Domain/Models/CarreraAcademicaModel.php';

interface UpdateCarreraAcademicaUseCase
{
    public function execute(UpdateCarreraAcademicaCommand $command): CarreraAcademicaModel;
}