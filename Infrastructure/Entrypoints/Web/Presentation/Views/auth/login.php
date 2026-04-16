<?php
declare(strict_types=1);

$pageTitle = isset($pageTitle) ? (string) $pageTitle : 'Iniciar sesión';
$message = $message ?? null;
$success = $success ?? null;
$errors = $errors ?? array();
$old = $old ?? array();

require __DIR__ . '/../layouts/header.php';
require __DIR__ . '/../layouts/menu.php';
?>

<div class="encabezado">
    <h1>Inicio de sesión</h1>
    <p>Accede para administrar el sistema</p>
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

    <form action="?route=auth.authenticate" method="POST">
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

            <div class="campo-completo">
                <label for="password">Contraseña</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    required
                >
            </div>
        </div>

        <div class="botones">
            <button type="submit" class="btn btn-primario">Iniciar sesión</button>
            <a href="?route=auth.forgot" class="btn btn-exito">Recuperar contraseña</a>
        </div>
    </form>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>