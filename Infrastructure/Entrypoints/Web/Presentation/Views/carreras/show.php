<?php
declare(strict_types=1);

$pageTitle = isset($pageTitle) ? (string) $pageTitle : 'Detalle de carrera académica';
$message = $message ?? null;
$success = $success ?? null;

require __DIR__ . '/../layouts/header.php';
require __DIR__ . '/../layouts/menu.php';
?>

<div class="encabezado">
    <h1>Detalle de Carrera Académica</h1>
    <p>Consulta detallada de la información registrada</p>
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

    <h2><?php echo htmlspecialchars($carrera->getNombre(), ENT_QUOTES, 'UTF-8'); ?></h2>

    <div class="grid">
        <div>
            <label>ID</label>
            <input type="text" value="<?php echo htmlspecialchars((string) $carrera->getId(), ENT_QUOTES, 'UTF-8'); ?>" readonly>
        </div>

        <div>
            <label>Nivel de formación</label>
            <input type="text" value="<?php echo htmlspecialchars($carrera->getNivelFormacion(), ENT_QUOTES, 'UTF-8'); ?>" readonly>
        </div>

        <div>
            <label>Número de créditos</label>
            <input type="text" value="<?php echo htmlspecialchars((string) $carrera->getNumCreditos(), ENT_QUOTES, 'UTF-8'); ?>" readonly>
        </div>

        <div>
            <label>Número de asignaturas</label>
            <input type="text" value="<?php echo htmlspecialchars((string) $carrera->getNumAsignaturas(), ENT_QUOTES, 'UTF-8'); ?>" readonly>
        </div>

        <div>
            <label>Número de semestres</label>
            <input type="text" value="<?php echo htmlspecialchars((string) $carrera->getNumSemestres(), ENT_QUOTES, 'UTF-8'); ?>" readonly>
        </div>

        <div>
            <label>Valor del semestre</label>
            <input type="text" value="<?php echo htmlspecialchars(number_format($carrera->getValorSemestre(), 2, ',', '.'), ENT_QUOTES, 'UTF-8'); ?>" readonly>
        </div>

        <div>
            <label>Título otorgado</label>
            <input type="text" value="<?php echo htmlspecialchars($carrera->getTitulo(), ENT_QUOTES, 'UTF-8'); ?>" readonly>
        </div>

        <div>
            <label>Universidad</label>
            <input type="text" value="<?php echo htmlspecialchars($carrera->getUniversidad(), ENT_QUOTES, 'UTF-8'); ?>" readonly>
        </div>

        <div>
            <label>¿Es acreditada?</label>
            <input type="text" value="<?php echo htmlspecialchars($carrera->getEsAcreditada(), ENT_QUOTES, 'UTF-8'); ?>" readonly>
        </div>

        <div>
            <label>Área de conocimiento</label>
            <input type="text" value="<?php echo htmlspecialchars($carrera->getAreaConocimiento(), ENT_QUOTES, 'UTF-8'); ?>" readonly>
        </div>

        <div class="campo-completo">
            <label>Perfiles</label>
            <textarea readonly><?php echo htmlspecialchars($carrera->getPerfiles(), ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>
    </div>

    <div class="botones">
        <a href="?route=carreras.index" class="btn btn-exito">Volver al listado</a>
        <a href="?route=carreras.edit&id=<?php echo urlencode((string) $carrera->getId()); ?>" class="btn btn-alerta">Editar</a>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>