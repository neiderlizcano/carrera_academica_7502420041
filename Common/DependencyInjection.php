<?php
declare(strict_types=1);

require_once __DIR__ . '/ClassLoader.php';

require_once __DIR__ . '/../src/CarreraAcademica/Domain/Models/CarreraAcademicaModel.php';

require_once __DIR__ . '/../src/CarreraAcademica/Application/Ports/In/CreateCarreraAcademicaUseCase.php';
require_once __DIR__ . '/../src/CarreraAcademica/Application/Ports/In/GetAllCarrerasAcademicasUseCase.php';
require_once __DIR__ . '/../src/CarreraAcademica/Application/Ports/In/GetCarreraAcademicaByIdUseCase.php';
require_once __DIR__ . '/../src/CarreraAcademica/Application/Ports/In/UpdateCarreraAcademicaUseCase.php';
require_once __DIR__ . '/../src/CarreraAcademica/Application/Ports/In/DeleteCarreraAcademicaUseCase.php';

require_once __DIR__ . '/../src/CarreraAcademica/Application/Ports/Out/SaveCarreraAcademicaPort.php';
require_once __DIR__ . '/../src/CarreraAcademica/Application/Ports/Out/UpdateCarreraAcademicaPort.php';
require_once __DIR__ . '/../src/CarreraAcademica/Application/Ports/Out/DeleteCarreraAcademicaPort.php';
require_once __DIR__ . '/../src/CarreraAcademica/Application/Ports/Out/GetCarreraAcademicaByIdPort.php';
require_once __DIR__ . '/../src/CarreraAcademica/Application/Ports/Out/GetAllCarrerasAcademicasPort.php';

require_once __DIR__ . '/../src/CarreraAcademica/Application/Ports/In/LoginUseCase.php';
require_once __DIR__ . '/../src/CarreraAcademica/Application/Ports/Out/GetUserByEmailPort.php';
require_once __DIR__ . '/../src/CarreraAcademica/Application/Ports/In/ForgotPasswordUseCase.php';
require_once __DIR__ . '/../src/CarreraAcademica/Application/Ports/Out/UpdateUserPort.php';

require_once __DIR__ . '/../src/CarreraAcademica/Application/Services/Dto/Commands/LoginCommand.php';
require_once __DIR__ . '/../src/CarreraAcademica/Application/Services/Dto/Commands/ForgotPasswordCommand.php';
require_once __DIR__ . '/../src/CarreraAcademica/Application/Services/Dto/Commands/CreateCarreraAcademicaCommand.php';
require_once __DIR__ . '/../src/CarreraAcademica/Application/Services/Dto/Commands/UpdateCarreraAcademicaCommand.php';
require_once __DIR__ . '/../src/CarreraAcademica/Application/Services/Dto/Commands/DeleteCarreraAcademicaCommand.php';
require_once __DIR__ . '/../src/CarreraAcademica/Application/Services/Dto/Queries/GetCarreraAcademicaByIdQuery.php';
require_once __DIR__ . '/../src/CarreraAcademica/Application/Services/Dto/Queries/GetAllCarrerasAcademicasQuery.php';

require_once __DIR__ . '/../src/CarreraAcademica/Application/Services/Mappers/CarreraApplicationMapper.php';
require_once __DIR__ . '/../src/CarreraAcademica/Application/Services/CreateCarreraAcademicaService.php';
require_once __DIR__ . '/../src/CarreraAcademica/Application/Services/UpdateCarreraAcademicaService.php';
require_once __DIR__ . '/../src/CarreraAcademica/Application/Services/DeleteCarreraAcademicaService.php';
require_once __DIR__ . '/../src/CarreraAcademica/Application/Services/GetCarreraAcademicaByIdService.php';
require_once __DIR__ . '/../src/CarreraAcademica/Application/Services/GetAllCarrerasAcademicasService.php';

require_once __DIR__ . '/../src/CarreraAcademica/Application/Services/LoginService.php';
require_once __DIR__ . '/../src/CarreraAcademica/Application/Services/ForgotPasswordService.php';

require_once __DIR__ . '/../src/CarreraAcademica/Infrastructure/Adapters/Persistence/MySQL/Config/Connection.php';

require_once __DIR__ . '/../src/CarreraAcademica/Infrastructure/Adapters/Persistence/MySQL/Dto/UserPersistenceDto.php';
require_once __DIR__ . '/../src/CarreraAcademica/Infrastructure/Adapters/Persistence/MySQL/Entity/UserEntity.php';
require_once __DIR__ . '/../src/CarreraAcademica/Infrastructure/Adapters/Persistence/MySQL/Mapper/UserPersistenceMapper.php';
require_once __DIR__ . '/../src/CarreraAcademica/Infrastructure/Adapters/Persistence/MySQL/Repository/UserRepositoryMySQL.php';

require_once __DIR__ . '/../src/CarreraAcademica/Infrastructure/Adapters/Persistence/MySQL/Dto/CarreraPersistenceDto.php';
require_once __DIR__ . '/../src/CarreraAcademica/Infrastructure/Adapters/Persistence/MySQL/Entity/CarreraEntity.php';
require_once __DIR__ . '/../src/CarreraAcademica/Infrastructure/Adapters/Persistence/MySQL/Mapper/CarreraPersistenceMapper.php';
require_once __DIR__ . '/../src/CarreraAcademica/Infrastructure/Adapters/Persistence/MySQL/Repository/CarreraRepositoryMySQL.php';

require_once __DIR__ . '/../Infrastructure/Entrypoints/Web/Controllers/Mapper/CarreraAcademicaWebMapper.php';
require_once __DIR__ . '/../Infrastructure/Entrypoints/Web/Controllers/CarreraAcademicaController.php';

final class DependencyInjection
{
    public static function boot(): void
    {
        ClassLoader::register();
    }

    public static function getCarreraAcademicaRepository(): CarreraRepositoryMySQL
    {
        return new CarreraRepositoryMySQL();
    }

    public static function getUserRepository(): UserRepositoryMySQL
    {
        return new UserRepositoryMySQL();
    }

    public static function getCreateCarreraAcademicaUseCase(): CreateCarreraAcademicaService
    {
        return new CreateCarreraAcademicaService(
            self::getCarreraAcademicaRepository(),
            new CarreraApplicationMapper()
        );
    }

    public static function getUpdateCarreraAcademicaUseCase(): UpdateCarreraAcademicaService
    {
        return new UpdateCarreraAcademicaService(
            self::getCarreraAcademicaRepository(),
            new CarreraApplicationMapper()
        );
    }

    public static function getDeleteCarreraAcademicaUseCase(): DeleteCarreraAcademicaService
    {
        return new DeleteCarreraAcademicaService(
            self::getCarreraAcademicaRepository()
        );
    }

    public static function getGetCarreraAcademicaByIdUseCase(): GetCarreraAcademicaByIdService
    {
        return new GetCarreraAcademicaByIdService(
            self::getCarreraAcademicaRepository()
        );
    }

    public static function getGetAllCarrerasAcademicasUseCase(): GetAllCarrerasAcademicasService
    {
        return new GetAllCarrerasAcademicasService(
            self::getCarreraAcademicaRepository()
        );
    }

    public static function getLoginUseCase(): LoginService
    {
        return new LoginService(self::getUserRepository());
    }

    public static function getForgotPasswordUseCase(): ForgotPasswordService
    {
        return new ForgotPasswordService(
            self::getUserRepository(),
            self::getUserRepository()
        );
    }

    public static function getCarreraAcademicaController(): CarreraAcademicaController
    {
        return new CarreraAcademicaController(
            self::getCreateCarreraAcademicaUseCase(),
            self::getGetAllCarrerasAcademicasUseCase(),
            self::getGetCarreraAcademicaByIdUseCase(),
            self::getUpdateCarreraAcademicaUseCase(),
            self::getDeleteCarreraAcademicaUseCase(),
            new CarreraAcademicaWebMapper()
        );
    }
}