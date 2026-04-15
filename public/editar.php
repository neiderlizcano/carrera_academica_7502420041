<?php

require_once dirname(__DIR__) . '/src/CarreraAcademica/Domain/Entity/CarreraAcademica.php';
require_once dirname(__DIR__) . '/src/CarreraAcademica/Domain/Repository/CarreraAcademicaRepository.php';
require_once dirname(__DIR__) . '/src/CarreraAcademica/Application/UseCase/BuscarCarreraAcademicaPorIdUseCase.php';
require_once dirname(__DIR__) . '/src/CarreraAcademica/Infrastructure/Persistence/conexion.php';
require_once dirname(__DIR__) . '/src/CarreraAcademica/Infrastructure/Persistence/MySqlCarreraAcademicaRepository.php';

use Src\CarreraAcademica\Application\UseCase\BuscarCarreraAcademicaPorIdUseCase;
use Src\CarreraAcademica\Infrastructure\Persistence\MySqlCarreraAcademicaRepository;

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    header('Location: listar.php?mensaje=error');
    exit();
}

$repositorio = new MySqlCarreraAcademicaRepository($conn);
$casoDeUso = new BuscarCarreraAcademicaPorIdUseCase($repositorio);
$carrera = $casoDeUso->ejecutar($id);

$conn->close();

if (!$carrera) {
    header('Location: listar.php?mensaje=error');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Carrera Académica</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #eaf2ff, #f8fbff);
            color: #1f2937;
        }

        .encabezado {
            background: #0d6efd;
            color: white;
            padding: 25px 20px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.12);
        }

        .encabezado h1 {
            margin: 0;
            font-size: 34px;
        }

        .contenedor {
            max-width: 950px;
            margin: 30px auto;
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
        }

        h2 {
            margin-top: 0;
            text-align: center;
            color: #0d3b66;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .campo-completo {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input, select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            font-size: 15px;
            outline: none;
            transition: 0.2s ease;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 3px rgba(13,110,253,0.15);
        }

        textarea {
            resize: vertical;
            min-height: 110px;
        }

        .botones {
            margin-top: 25px;
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn {
            text-decoration: none;
            border: none;
            padding: 13px 18px;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
            font-size: 15px;
            display: inline-block;
        }

        .btn-actualizar {
            background: #0d6efd;
            color: white;
        }

        .btn-volver {
            background: #198754;
            color: white;
        }

        @media (max-width: 768px) {
            .grid {
                grid-template-columns: 1fr;
            }

            .contenedor {
                margin: 15px;
                padding: 20px;
            }

            .encabezado h1 {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>

    <div class="encabezado">
        <h1>Editar Carrera Académica</h1>
    </div>

    <div class="contenedor">
        <h2>Formulario de Edición</h2>

        <form action="actualizar.php" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars((string) $carrera->getId()); ?>">

            <div class="grid">
                <div>
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($carrera->getNombre()); ?>" required>
                </div>

                <div>
                    <label for="nivelFormacion">Nivel de formación</label>
                    <select name="nivelFormacion" id="nivelFormacion" required>
                        <option value="">Seleccione</option>
                        <option value="Técnico" <?php echo $carrera->getNivelFormacion() === 'Técnico' ? 'selected' : ''; ?>>Técnico</option>
                        <option value="Tecnólogo" <?php echo $carrera->getNivelFormacion() === 'Tecnólogo' ? 'selected' : ''; ?>>Tecnólogo</option>
                        <option value="Profesional" <?php echo $carrera->getNivelFormacion() === 'Profesional' ? 'selected' : ''; ?>>Profesional</option>
                        <option value="Especialización" <?php echo $carrera->getNivelFormacion() === 'Especialización' ? 'selected' : ''; ?>>Especialización</option>
                        <option value="Maestría" <?php echo $carrera->getNivelFormacion() === 'Maestría' ? 'selected' : ''; ?>>Maestría</option>
                        <option value="Doctorado" <?php echo $carrera->getNivelFormacion() === 'Doctorado' ? 'selected' : ''; ?>>Doctorado</option>
                    </select>
                </div>

                <div>
                    <label for="numCreditos">Número de créditos</label>
                    <input type="number" name="numCreditos" id="numCreditos" min="0" value="<?php echo htmlspecialchars((string) $carrera->getNumCreditos()); ?>" required>
                </div>

                <div>
                    <label for="numAsignaturas">Número de asignaturas</label>
                    <input type="number" name="numAsignaturas" id="numAsignaturas" min="0" value="<?php echo htmlspecialchars((string) $carrera->getNumAsignaturas()); ?>" required>
                </div>

                <div>
                    <label for="numSemestres">Número de semestres</label>
                    <input type="number" name="numSemestres" id="numSemestres" min="0" value="<?php echo htmlspecialchars((string) $carrera->getNumSemestres()); ?>" required>
                </div>

                <div>
                    <label for="valorSemestre">Valor del semestre</label>
                    <input type="number" name="valorSemestre" id="valorSemestre" min="0" step="0.01" value="<?php echo htmlspecialchars((string) $carrera->getValorSemestre()); ?>" required>
                </div>

                <div>
                    <label for="titulo">Título otorgado</label>
                    <input type="text" name="titulo" id="titulo" value="<?php echo htmlspecialchars($carrera->getTitulo()); ?>" required>
                </div>

                <div>
                    <label for="universidad">Universidad</label>
                    <input type="text" name="universidad" id="universidad" value="<?php echo htmlspecialchars($carrera->getUniversidad()); ?>" required>
                </div>

                <div>
                    <label for="esAcreditada">¿Es acreditada?</label>
                    <select name="esAcreditada" id="esAcreditada" required>
                        <option value="">Seleccione</option>
                        <option value="Sí" <?php echo $carrera->getEsAcreditada() === 'Sí' ? 'selected' : ''; ?>>Sí</option>
                        <option value="No" <?php echo $carrera->getEsAcreditada() === 'No' ? 'selected' : ''; ?>>No</option>
                    </select>
                </div>

                <div>
                    <label for="areaConocimiento">Área de conocimiento</label>
                    <input type="text" name="areaConocimiento" id="areaConocimiento" value="<?php echo htmlspecialchars($carrera->getAreaConocimiento()); ?>" required>
                </div>

                <div class="campo-completo">
                    <label for="perfiles">Perfiles</label>
                    <textarea name="perfiles" id="perfiles" required><?php echo htmlspecialchars($carrera->getPerfiles()); ?></textarea>
                </div>
            </div>

            <div class="botones">
                <button type="submit" class="btn btn-actualizar">Actualizar registro</button>
                <a href="listar.php" class="btn btn-volver">Volver a la lista</a>
            </div>
        </form>
    </div>

</body>
</html>