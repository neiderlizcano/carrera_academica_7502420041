<?php
declare(strict_types=1);
/** @var string $pageTitle */
/** @var string|null $message */
/** @var string|null $success */

require __DIR__ . '/layouts/header.php';
require __DIR__ . '/layouts/menu.php';
?>

<div class="encabezado">
    <h1>Sistema de Gestión de Carrera Académica</h1>
    <p>Aplicación web en PHP orientado a objetos con DDD y Arquitectura Hexagonal</p>
</div>

<div class="contenedor">
    <?php if (!empty($message)): ?>
        <div class="mensaje error">
            <?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="mensaje success">
            <?php echo htmlspecialchars($success, ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>

    <h2>Bienvenido</h2>
    <p>
        Desde aquí podrás registrar, consultar, editar y eliminar carreras académicas usando la
        estructura definida en las guías del curso.
    </p>

    <div class="botones">
        <a href="?route=carreras.create" class="btn btn-primario">Ir al formulario</a>
        <a href="?route=carreras.index" class="btn btn-exito">Ver registros</a>
    </div>
</div>

<?php require __DIR__ . '/layouts/footer.php'; ?>