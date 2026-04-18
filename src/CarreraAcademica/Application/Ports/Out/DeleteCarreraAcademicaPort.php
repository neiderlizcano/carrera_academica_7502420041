<?php
declare(strict_types=1);

interface DeleteCarreraAcademicaPort
{
    public function delete(int $id): void;
}