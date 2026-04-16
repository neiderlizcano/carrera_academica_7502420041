<?php
declare(strict_types=1);

require_once __DIR__ . '/ClassLoader.php';

require_once __DIR__ . '/../src/CarreraAcademica/Domain/Entity/CarreraAcademica.php';
require_once __DIR__ . '/../src/CarreraAcademica/Domain/Repository/CarreraAcademicaRepository.php';

require_once __DIR__ . '/../src/CarreraAcademica/Application/UseCase/GuardarCarreraAcademicaUseCase.php';
require_once __DIR__ . '/../src/CarreraAcademica/Application/UseCase/ListarCarreraAcademicaUseCase.php';
require_once __DIR__ . '/../src/CarreraAcademica/Application/UseCase/BuscarCarreraAcademicaPorIdUseCase.php';
require_once __DIR__ . '/../src/CarreraAcademica/Application/UseCase/ActualizarCarreraAcademicaUseCase.php';
require_once __DIR__ . '/../src/CarreraAcademica/Application/UseCase/EliminarCarreraAcademicaUseCase.php';

require_once __DIR__ . '/../src/CarreraAcademica/Application/Ports/In/LoginUseCase.php';
require_once __DIR__ . '/../src/CarreraAcademica/Application/Ports/Out/GetUserByEmailPort.php';
require_once __DIR__ . '/../src/CarreraAcademica/Application/Services/Dto/Commands/LoginCommand.php';
require_once __DIR__ . '/../src/CarreraAcademica/Application/Services/LoginService.php';

require_once __DIR__ . '/../src/CarreraAcademica/Infrastructure/Persistence/MySqlCarreraAcademicaRepository.php';
require_once __DIR__ . '/../src/CarreraAcademica/Infrastructure/Persistence/MySqlUserRepository.php';

require_once __DIR__ . '/../Infrastructure/Entrypoints/Web/Controllers/CarreraAcademicaController.php';

require_once __DIR__ . '/../src/CarreraAcademica/Application/Ports/In/ForgotPasswordUseCase.php';
require_once __DIR__ . '/../src/CarreraAcademica/Application/Ports/Out/UpdateUserPort.php';
require_once __DIR__ . '/../src/CarreraAcademica/Application/Services/Dto/Commands/ForgotPasswordCommand.php';
require_once __DIR__ . '/../src/CarreraAcademica/Application/Services/ForgotPasswordService.php';

use Src\CarreraAcademica\Application\UseCase\GuardarCarreraAcademicaUseCase;
use Src\CarreraAcademica\Application\UseCase\ListarCarreraAcademicaUseCase;
use Src\CarreraAcademica\Application\UseCase\BuscarCarreraAcademicaPorIdUseCase;
use Src\CarreraAcademica\Application\UseCase\ActualizarCarreraAcademicaUseCase;
use Src\CarreraAcademica\Application\UseCase\EliminarCarreraAcademicaUseCase;
use Src\CarreraAcademica\Infrastructure\Persistence\MySqlCarreraAcademicaRepository;

final class DependencyInjection
{
    public static function boot(): void
    {
        ClassLoader::register();
    }

    public static function getConnection(): mysqli
    {
        require __DIR__ . '/../src/CarreraAcademica/Infrastructure/Persistence/conexion.php';

        return $conn;
    }

    public static function getCarreraAcademicaRepository(): MySqlCarreraAcademicaRepository
    {
        return new MySqlCarreraAcademicaRepository(self::getConnection());
    }

    public static function getUserRepository(): MySqlUserRepository
    {
        return new MySqlUserRepository(self::getConnection());
    }

    public static function getGuardarCarreraAcademicaUseCase(): GuardarCarreraAcademicaUseCase
    {
        return new GuardarCarreraAcademicaUseCase(self::getCarreraAcademicaRepository());
    }

    public static function getListarCarreraAcademicaUseCase(): ListarCarreraAcademicaUseCase
    {
        return new ListarCarreraAcademicaUseCase(self::getCarreraAcademicaRepository());
    }

    public static function getBuscarCarreraAcademicaPorIdUseCase(): BuscarCarreraAcademicaPorIdUseCase
    {
        return new BuscarCarreraAcademicaPorIdUseCase(self::getCarreraAcademicaRepository());
    }

    public static function getActualizarCarreraAcademicaUseCase(): ActualizarCarreraAcademicaUseCase
    {
        return new ActualizarCarreraAcademicaUseCase(self::getCarreraAcademicaRepository());
    }

    public static function getEliminarCarreraAcademicaUseCase(): EliminarCarreraAcademicaUseCase
    {
        return new EliminarCarreraAcademicaUseCase(self::getCarreraAcademicaRepository());
    }

    public static function getLoginUseCase(): LoginService
    {
        return new LoginService(self::getUserRepository());
    }

    public static function getCarreraAcademicaController(): CarreraAcademicaController
    {
        return new CarreraAcademicaController(
            self::getGuardarCarreraAcademicaUseCase(),
            self::getListarCarreraAcademicaUseCase(),
            self::getBuscarCarreraAcademicaPorIdUseCase(),
            self::getActualizarCarreraAcademicaUseCase(),
            self::getEliminarCarreraAcademicaUseCase()
        );
    }
    public static function getForgotPasswordUseCase(): ForgotPasswordService
    {
    return new ForgotPasswordService(
        self::getUserRepository(),
        self::getUserRepository()
    );
    }
}
