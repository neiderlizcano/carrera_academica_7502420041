<?php
declare(strict_types=1);

$pageTitle = isset($pageTitle) ? (string) $pageTitle : 'Recuperar contraseña';
$message = $message ?? null;
$success = $success ?? null;

require __DIR__ . '/../layouts/header.php';
require __DIR__ . '/../layouts/menu.php';
?>

<div class="encabezado">
    <h1>Recuperar contraseña</h1>
    <p>Esta pantalla se conectará en la siguiente fase</p>
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

    <p>Recuperación de contraseña en construcción según la guía.</p>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>