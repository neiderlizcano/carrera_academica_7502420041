<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperación de contraseña</title>
</head>
<body style="font-family: Arial, sans-serif; color: #1f2937;">
    <h2>Recuperación de contraseña</h2>
    <p>Hola, <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>.</p>
    <p>Se ha generado una contraseña temporal para tu acceso al sistema.</p>

    <p><strong>Correo:</strong> <?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?></p>
    <p><strong>Contraseña temporal:</strong> <?php echo htmlspecialchars($tempPassword, ENT_QUOTES, 'UTF-8'); ?></p>

    <p>Después de ingresar, cambia tu contraseña por una más segura.</p>
</body>
</html>