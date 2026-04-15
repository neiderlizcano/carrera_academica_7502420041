<?php
$mensaje = "";
$tipoMensaje = "";

if (isset($_GET["mensaje"])) {
    if ($_GET["mensaje"] == "ok") {
        $mensaje = "Registro guardado correctamente.";
        $tipoMensaje = "exito";
    } elseif ($_GET["mensaje"] == "error") {
        $mensaje = "Ocurrió un error al guardar.";
        $tipoMensaje = "error";
    } elseif ($_GET["mensaje"] == "vacio") {
        $mensaje = "Debes completar todos los campos.";
        $tipoMensaje = "alerta";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Carrera Académica</title>
    <style>
        * { box-sizing: border-box; }

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

        .encabezado p {
            margin-top: 8px;
            font-size: 16px;
            opacity: 0.95;
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

        .mensaje {
            padding: 14px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .exito {
            background-color: #e8f8ee;
            color: #146c43;
            border: 1px solid #badbcc;
        }

        .error {
            background-color: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
        }

        .alerta {
            background-color: #fff3cd;
            color: #664d03;
            border: 1px solid #ffecb5;
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
        }

        .btn-guardar {
            background: #0d6efd;
            color: white;
        }

        .btn-ver {
            background: #198754;
            color: white;
            display: inline-block;
        }

        .pie {
            text-align: center;
            margin-top: 18px;
            color: #6b7280;
            font-size: 14px;
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
        <h1>Sistema de Gestión de Carrera Académica</h1>
        <p>Registro y administración de información académica con PHP y MySQL</p>
    </div>

    <div class="contenedor">
        <h2>Formulario de Registro</h2>

        <?php if ($mensaje != ""): ?>
            <div class="mensaje <?php echo $tipoMensaje; ?>">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>

        <form action="guardar.php" method="POST">
            <div class="grid">
                <div>
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" required>
                </div>

                <div>
                    <label for="nivelFormacion">Nivel de formación</label>
                    <select name="nivelFormacion" id="nivelFormacion" required>
                        <option value="">Seleccione</option>
                        <option value="Técnico">Técnico</option>
                        <option value="Tecnólogo">Tecnólogo</option>
                        <option value="Profesional">Profesional</option>
                        <option value="Especialización">Especialización</option>
                        <option value="Maestría">Maestría</option>
                        <option value="Doctorado">Doctorado</option>
                    </select>
                </div>

                <div>
                    <label for="numCreditos">Número de créditos</label>
                    <input type="number" name="numCreditos" id="numCreditos" min="0" required>
                </div>

                <div>
                    <label for="numAsignaturas">Número de asignaturas</label>
                    <input type="number" name="numAsignaturas" id="numAsignaturas" min="0" required>
                </div>

                <div>
                    <label for="numSemestres">Número de semestres</label>
                    <input type="number" name="numSemestres" id="numSemestres" min="0" required>
                </div>

                <div>
                    <label for="valorSemestre">Valor del semestre</label>
                    <input type="number" name="valorSemestre" id="valorSemestre" min="0" step="0.01" required>
                </div>

                <div>
                    <label for="titulo">Título otorgado</label>
                    <input type="text" name="titulo" id="titulo" required>
                </div>

                <div>
                    <label for="universidad">Universidad</label>
                    <input type="text" name="universidad" id="universidad" required>
                </div>

                <div>
                    <label for="esAcreditada">¿Es acreditada?</label>
                    <select name="esAcreditada" id="esAcreditada" required>
                        <option value="">Seleccione</option>
                        <option value="Sí">Sí</option>
                        <option value="No">No</option>
                    </select>
                </div>

                <div>
                    <label for="areaConocimiento">Área de conocimiento</label>
                    <input type="text" name="areaConocimiento" id="areaConocimiento" required>
                </div>

                <div class="campo-completo">
                    <label for="perfiles">Perfiles</label>
                    <textarea name="perfiles" id="perfiles" required></textarea>
                </div>
            </div>

            <div class="botones">
                <button type="submit" class="btn btn-guardar">Guardar registro</button>
                <a href="listar.php" class="btn btn-ver">Ver registros</a>
            </div>
        </form>

        <div class="pie">
            Proyecto académico - CRUD de Carrera Académica
        </div>
    </div>

</body>
</html>