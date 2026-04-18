<?php
declare(strict_types=1);

final class ClassLoader
{
    private static array $classMap = array(
        'ClassLoader' => __DIR__ . '/ClassLoader.php',
        'DependencyInjection' => __DIR__ . '/DependencyInjection.php',

        'WebRoutes' => __DIR__ . '/../Infrastructure/Entrypoints/Web/Config/WebRoutes.php',
        'Flash' => __DIR__ . '/../Infrastructure/Entrypoints/Web/Presentation/Flash.php',
        'View' => __DIR__ . '/../Infrastructure/Entrypoints/Web/Presentation/View.php',
        'CarreraAcademicaController' => __DIR__ . '/../Infrastructure/Entrypoints/Web/Controllers/CarreraAcademicaController.php',
    );

    public static function register(): void
    {
        spl_autoload_register(array(self::class, 'loadClass'));
    }

    public static function loadClass(string $className): void
    {
        if (!isset(self::$classMap[$className])) {
            return;
        }

        $file = self::$classMap[$className];

        if (file_exists($file)) {
            require_once $file;
        }
    }
}