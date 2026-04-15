<?php
declare(strict_types=1);

$pageTitle = isset($pageTitle) ? (string) $pageTitle : 'Registrar carrera académica';
$message = $message ?? null;
$success = $success ?? null;
$errors = $errors ?? array();
$old = $old ?? array();

require __DIR__ . '/../layouts/header.php';
require __DIR__ . '/../layouts/menu.php';
?>

<div class="encabezado">
    <h1>Sistema de Gestión de Carrera Académica</h1>
    <p>Registro y administración de información académica</p>
</div>

<div class="contenedor">
    <h2>Formulario de Registro</h2>

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

    <form action="?route=carreras.store" method="POST">
        <div class="grid">
            <div>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars((string) ($old['nombre'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div>
                <label for="nivelFormacion">Nivel de formación</label>
                <select name="nivelFormacion" id="nivelFormacion" required>
                    <option value="">Seleccione</option>
                    <?php $nivelActual = (string) ($old['nivelFormacion'] ?? ''); ?>
                    <option value="Técnico" <?php echo $nivelActual === 'Técnico' ? 'selected' : ''; ?>>Técnico</option>
                    <option value="Tecnólogo" <?php echo $nivelActual === 'Tecnólogo' ? 'selected' : ''; ?>>Tecnólogo</option>
                    <option value="Profesional" <?php echo $nivelActual === 'Profesional' ? 'selected' : ''; ?>>Profesional</option>
                    <option value="Especialización" <?php echo $nivelActual === 'Especialización' ? 'selected' : ''; ?>>Especialización</option>
                    <option value="Maestría" <?php echo $nivelActual === 'Maestría' ? 'selected' : ''; ?>>Maestría</option>
                    <option value="Doctorado" <?php echo $nivelActual === 'Doctorado' ? 'selected' : ''; ?>>Doctorado</option>
                </select>
            </div>

            <div>
                <label for="numCreditos">Número de créditos</label>
                <input type="number" name="numCreditos" id="numCreditos" min="0" value="<?php echo htmlspecialchars((string) ($old['numCreditos'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div>
                <label for="numAsignaturas">Número de asignaturas</label>
                <input type="number" name="numAsignaturas" id="numAsignaturas" min="0" value="<?php echo htmlspecialchars((string) ($old['numAsignaturas'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div>
                <label for="numSemestres">Número de semestres</label>
                <input type="number" name="numSemestres" id="numSemestres" min="0" value="<?php echo htmlspecialchars((string) ($old['numSemestres'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div>
                <label for="valorSemestre">Valor del semestre</label>
                <input type="number" name="valorSemestre" id="valorSemestre" min="0" step="0.01" value="<?php echo htmlspecialchars((string) ($old['valorSemestre'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div>
                <label for="titulo">Título otorgado</label>
                <input type="text" name="titulo" id="titulo" value="<?php echo htmlspecialchars((string) ($old['titulo'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div>
                <label for="universidad">Universidad</label>
                <input type="text" name="universidad" id="universidad" value="<?php echo htmlspecialchars((string) ($old['universidad'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div>
                <label for="esAcreditada">¿Es acreditada?</label>
                <?php $acreditadaActual = (string) ($old['esAcreditada'] ?? ''); ?>
                <select name="esAcreditada" id="esAcreditada" required>
                    <option value="">Seleccione</option>
                    <option value="Sí" <?php echo $acreditadaActual === 'Sí' ? 'selected' : ''; ?>>Sí</option>
                    <option value="No" <?php echo $acreditadaActual === 'No' ? 'selected' : ''; ?>>No</option>
                </select>
            </div>

            <div>
                <label for="areaConocimiento">Área de conocimiento</label>
                <input type="text" name="areaConocimiento" id="areaConocimiento" value="<?php echo htmlspecialchars((string) ($old['areaConocimiento'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="campo-completo">
                <label for="perfiles">Perfiles</label>
                <textarea name="perfiles" id="perfiles" required><?php echo htmlspecialchars((string) ($old['perfiles'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></textarea>
            </div>
        </div>

        <div class="botones">
            <button type="submit" class="btn btn-primario">Guardar registro</button>
            <a href="?route=carreras.index" class="btn btn-exito">Ver registros</a>
        </div>
    </form>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>