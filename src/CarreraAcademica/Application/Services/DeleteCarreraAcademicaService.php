<?php
declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/DeleteCarreraAcademicaUseCase.php';
require_once __DIR__ . '/../Ports/Out/DeleteCarreraAcademicaPort.php';

final class DeleteCarreraAcademicaService implements DeleteCarreraAcademicaUseCase
{
    public function __construct(
        private DeleteCarreraAcademicaPort $deleteCarreraAcademicaPort
    ) {
    }

    public function execute(DeleteCarreraAcademicaCommand $command): void
    {
        $this->deleteCarreraAcademicaPort->delete((int) $command->getId());
    }
}