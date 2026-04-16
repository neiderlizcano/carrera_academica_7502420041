<?php
declare(strict_types=1);

$pageTitle = isset($pageTitle) ? (string) $pageTitle : 'Editar carrera académica';
$message = $message ?? null;
$success = $success ?? null;
$errors = $errors ?? array();
$old = $old ?? array();

require __DIR__ . '/../layouts/header.php';
require __DIR__ . '/../layouts/menu.php';

$nombre = (string) ($old['nombre'] ?? $carrera->getNombre());
$nivelFormacion = (string) ($old['nivelFormacion'] ?? $carrera->getNivelFormacion());
$numCreditos = (string) ($old['numCreditos'] ?? $carrera->getNumCreditos());
$numAsignaturas = (string) ($old['numAsignaturas'] ?? $carrera->getNumAsignaturas());
$numSemestres = (string) ($old['numSemestres'] ?? $carrera->getNumSemestres());
$valorSemestre = (string) ($old['valorSemestre'] ?? $carrera->getValorSemestre());
$titulo = (string) ($old['titulo'] ?? $carrera->getTitulo());
$universidad = (string) ($old['universidad'] ?? $carrera->getUniversidad());
$esAcreditada = (string) ($old['esAcreditada'] ?? $carrera->getEsAcreditada());
$areaConocimiento = (string) ($old['areaConocimiento'] ?? $carrera->getAreaConocimiento());
$perfiles = (string) ($old['perfiles'] ?? $carrera->getPerfiles());
?>

<div class="encabezado">
    <h1>Editar Carrera Académica</h1>
    <p>Actualización de la información registrada</p>
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

    <h2>Formulario de Edición</h2>

    <form action="?route=carreras.update" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars((string) $carrera->getId(), ENT_QUOTES, 'UTF-8'); ?>">

        <div class="grid">
            <div>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div>
                <label for="nivelFormacion">Nivel de formación</label>
                <select name="nivelFormacion" id="nivelFormacion" required>
                    <option value="">Seleccione</option>
                    <option value="Técnico" <?php echo $nivelFormacion === 'Técnico' ? 'selected' : ''; ?>>Técnico</option>
                    <option value="Tecnólogo" <?php echo $nivelFormacion === 'Tecnólogo' ? 'selected' : ''; ?>>Tecnólogo</option>
                    <option value="Profesional" <?php echo $nivelFormacion === 'Profesional' ? 'selected' : ''; ?>>Profesional</option>
                    <option value="Especialización" <?php echo $nivelFormacion === 'Especialización' ? 'selected' : ''; ?>>Especialización</option>
                    <option value="Maestría" <?php echo $nivelFormacion === 'Maestría' ? 'selected' : ''; ?>>Maestría</option>
                    <option value="Doctorado" <?php echo $nivelFormacion === 'Doctorado' ? 'selected' : ''; ?>>Doctorado</option>
                </select>
            </div>

            <div>
                <label for="numCreditos">Número de créditos</label>
                <input type="number" name="numCreditos" id="numCreditos" min="0" value="<?php echo htmlspecialchars($numCreditos, ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div>
                <label for="numAsignaturas">Número de asignaturas</label>
                <input type="number" name="numAsignaturas" id="numAsignaturas" min="0" value="<?php echo htmlspecialchars($numAsignaturas, ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div>
                <label for="numSemestres">Número de semestres</label>
                <input type="number" name="numSemestres" id="numSemestres" min="0" value="<?php echo htmlspecialchars($numSemestres, ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div>
                <label for="valorSemestre">Valor del semestre</label>
                <input type="number" name="valorSemestre" id="valorSemestre" min="0" step="0.01" value="<?php echo htmlspecialchars($valorSemestre, ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div>
                <label for="titulo">Título otorgado</label>
                <input type="text" name="titulo" id="titulo" value="<?php echo htmlspecialchars($titulo, ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div>
                <label for="universidad">Universidad</label>
                <input type="text" name="universidad" id="universidad" value="<?php echo htmlspecialchars($universidad, ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div>
                <label for="esAcreditada">¿Es acreditada?</label>
                <select name="esAcreditada" id="esAcreditada" required>
                    <option value="">Seleccione</option>
                    <option value="Sí" <?php echo $esAcreditada === 'Sí' ? 'selected' : ''; ?>>Sí</option>
                    <option value="No" <?php echo $esAcreditada === 'No' ? 'selected' : ''; ?>>No</option>
                </select>
            </div>

            <div>
                <label for="areaConocimiento">Área de conocimiento</label>
                <input type="text" name="areaConocimiento" id="areaConocimiento" value="<?php echo htmlspecialchars($areaConocimiento, ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="campo-completo">
                <label for="perfiles">Perfiles</label>
                <textarea name="perfiles" id="perfiles" required><?php echo htmlspecialchars($perfiles, ENT_QUOTES, 'UTF-8'); ?></textarea>
            </div>
        </div>

        <div class="botones">
            <button type="submit" class="btn btn-primario">Actualizar registro</button>
            <a href="?route=carreras.index" class="btn btn-exito">Volver a la lista</a>
        </div>
    </form>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>