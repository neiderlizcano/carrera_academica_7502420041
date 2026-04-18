<?php
declare(strict_types=1);

$pageTitle = isset($pageTitle) ? (string) $pageTitle : 'Inicio';
$message = $message ?? null;
$success = $success ?? null;

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
            <?php echo htmlspecialchars((string) $message, ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="mensaje success">
            <?php echo htmlspecialchars((string) $success, ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>

    <h2>Bienvenido</h2>
    <p>
        Desde aquí podrás registrar, consultar, editar y eliminar carreras académicas dentro del sistema.
    </p>

    <div class="botones">
        <a href="?route=carreras.create" class="btn btn-primario">Registrar carrera</a>
        <a href="?route=carreras.index" class="btn btn-exito">Listar carreras</a>
        <a href="?route=auth.logout" class="btn btn-alerta">Cerrar sesión</a>
    </div>
</div>

<?php require __DIR__ . '/layouts/footer.php'; ?>