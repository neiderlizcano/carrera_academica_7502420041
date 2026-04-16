<?php
declare(strict_types=1);

$pageTitle = isset($pageTitle) ? (string) $pageTitle : 'Recuperar contraseña';
$message = $message ?? null;
$success = $success ?? null;
$errors = $errors ?? array();
$old = $old ?? array();

require __DIR__ . '/../layouts/header.php';
require __DIR__ . '/../layouts/menu.php';
?>

<div class="encabezado">
    <h1>Recuperar contraseña</h1>
    <p>Solicita una contraseña temporal para ingresar al sistema</p>
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

    <form action="?route=auth.forgot.send" method="POST">
        <div class="grid">
            <div class="campo-completo">
                <label for="email">Correo institucional</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="<?php echo htmlspecialchars((string) ($old['email'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>"
                    required
                >
            </div>
        </div>

        <div class="botones">
            <button type="submit" class="btn btn-primario">Enviar recuperación</button>
            <a href="?route=auth.login" class="btn btn-exito">Volver al login</a>
        </div>
    </form>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>