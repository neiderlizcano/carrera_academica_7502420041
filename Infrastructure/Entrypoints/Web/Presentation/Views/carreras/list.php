<?php
declare(strict_types=1);

$pageTitle = isset($pageTitle) ? (string) $pageTitle : 'Listado de carreras académicas';
$message = $message ?? null;
$success = $success ?? null;
$carreras = $carreras ?? array();

require __DIR__ . '/../layouts/header.php';
require __DIR__ . '/../layouts/menu.php';
?>

<div class="encabezado">
    <h1>Registros de Carrera Académica</h1>
    <p>Listado general de carreras registradas</p>
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

    <div class="botones" style="margin-top: 0; margin-bottom: 20px;">
        <a href="?route=carreras.create" class="btn btn-exito">Registrar nueva carrera</a>
    </div>

    <div style="overflow-x:auto;">
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Créditos</th>
                <th>Asignaturas</th>
                <th>Semestres</th>
                <th>Nivel</th>
                <th>Título</th>
                <th>Valor semestre</th>
                <th>Universidad</th>
                <th>Acreditada</th>
                <th>Perfiles</th>
                <th>Área</th>
                <th>Acciones</th>
            </tr>

            <?php if (!empty($carreras)): ?>
                <?php foreach ($carreras as $carrera): ?>
                    <tr>
                        <td><?php echo htmlspecialchars((string) $carrera->getId(), ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($carrera->getNombre(), ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars((string) $carrera->getNumCreditos(), ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars((string) $carrera->getNumAsignaturas(), ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars((string) $carrera->getNumSemestres(), ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($carrera->getNivelFormacion(), ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($carrera->getTitulo(), ENT_QUOTES, 'UTF-8'); ?></td>
                        <td>$ <?php echo number_format($carrera->getValorSemestre(), 2, ',', '.'); ?></td>
                        <td><?php echo htmlspecialchars($carrera->getUniversidad(), ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($carrera->getEsAcreditada(), ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($carrera->getPerfiles(), ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($carrera->getAreaConocimiento(), ENT_QUOTES, 'UTF-8'); ?></td>
                        <td>
                            <div class="acciones">
                                <a class="btn btn-primario" href="?route=carreras.show&id=<?php echo urlencode((string) $carrera->getId()); ?>">
                                    Ver detalle
                                </a>

                                <a class="btn btn-alerta" href="?route=carreras.edit&id=<?php echo urlencode((string) $carrera->getId()); ?>">
                                    Editar
                                </a>

                                <form method="POST" action="?route=carreras.delete" onsubmit="return confirm('¿Seguro que deseas eliminar este registro?');">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars((string) $carrera->getId(), ENT_QUOTES, 'UTF-8'); ?>">
                                    <button type="submit" class="btn btn-peligro" style="width:100%;">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="13" style="text-align:center;font-weight:bold;color:#6b7280;">No hay registros todavía.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>