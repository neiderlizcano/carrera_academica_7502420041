<?php
declare(strict_types=1);

$isAuthenticated = isset($_SESSION['auth']['id']);
$userName = $isAuthenticated ? (string) ($_SESSION['auth']['name'] ?? 'Usuario') : '';
?>
<nav class="menu">
    <a href="?route=home">Inicio</a>

    <?php if ($isAuthenticated): ?>
        <a href="?route=carreras.create">Registrar carrera</a>
        <a href="?route=carreras.index">Listar carreras</a>
        <a href="?route=auth.logout">Cerrar sesión</a>
        <a href="javascript:void(0)" style="pointer-events:none; opacity:.95;">
            <?php echo htmlspecialchars($userName, ENT_QUOTES, 'UTF-8'); ?>
        </a>
    <?php else: ?>
        <a href="?route=auth.login">Iniciar sesión</a>
        <a href="?route=auth.forgot">Recuperar contraseña</a>
    <?php endif; ?>
</nav>