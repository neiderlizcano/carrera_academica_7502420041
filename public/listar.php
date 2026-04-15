<?php
require_once dirname(__DIR__) . '/src/CarreraAcademica/Infrastructure/Persistence/conexion.php';

$mensaje = "";
$tipoMensaje = "";

if (isset($_GET["mensaje"])) {
    if ($_GET["mensaje"] == "actualizado") {
        $mensaje = "Registro actualizado correctamente.";
        $tipoMensaje = "exito";
    } elseif ($_GET["mensaje"] == "eliminado") {
        $mensaje = "Registro eliminado correctamente.";
        $tipoMensaje = "exito";
    } elseif ($_GET["mensaje"] == "error") {
        $mensaje = "Ocurrió un error en la operación.";
        $tipoMensaje = "error";
    }
}

$sql = "SELECT * FROM carrera_academica ORDER BY id DESC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Carreras Académicas</title>
    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #eef4ff, #f9fbff);
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
            max-width: 1300px;
            margin: 30px auto;
            background: white;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
            overflow-x: auto;
        }

        .barra {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .btn-volver {
            text-decoration: none;
            background: #198754;
            color: white;
            padding: 12px 16px;
            border-radius: 10px;
            font-weight: bold;
        }

        .mensaje {
            padding: 14px;
            border-radius: 10px;
            margin-bottom: 18px;
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

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1500px;
        }

        th, td {
            border: 1px solid #dbe2ea;
            padding: 12px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background: #0d6efd;
            color: white;
            position: sticky;
            top: 0;
        }

        tr:nth-child(even) {
            background-color: #f8fbff;
        }

        tr:hover {
            background-color: #eef5ff;
        }

        .acciones {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .btn-editar, .btn-eliminar {
            text-decoration: none;
            color: white;
            padding: 9px 12px;
            border-radius: 8px;
            font-weight: bold;
            text-align: center;
        }

        .btn-editar {
            background: #ffc107;
            color: #212529;
        }

        .btn-eliminar {
            background: #dc3545;
        }

        .sin-registros {
            text-align: center;
            font-weight: bold;
            color: #6b7280;
            padding: 20px;
        }
    </style>
</head>
<body>

    <div class="encabezado">
        <h1>Registros de Carrera Académica</h1>
    </div>

    <div class="contenedor">
        <?php if ($mensaje != ""): ?>
            <div class="mensaje <?php echo $tipoMensaje; ?>">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>

        <div class="barra">
            <a href="index.php" class="btn-volver">Volver al formulario</a>
        </div>

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

            <?php if ($resultado && $resultado->num_rows > 0): ?>
                <?php while ($fila = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($fila["id"]); ?></td>
                        <td><?php echo htmlspecialchars($fila["nombre"]); ?></td>
                        <td><?php echo htmlspecialchars($fila["numCreditos"]); ?></td>
                        <td><?php echo htmlspecialchars($fila["numAsignaturas"]); ?></td>
                        <td><?php echo htmlspecialchars($fila["numSemestres"]); ?></td>
                        <td><?php echo htmlspecialchars($fila["nivelFormacion"]); ?></td>
                        <td><?php echo htmlspecialchars($fila["titulo"]); ?></td>
                        <td>$ <?php echo number_format($fila["valorSemestre"], 2, ",", "."); ?></td>
                        <td><?php echo htmlspecialchars($fila["universidad"]); ?></td>
                        <td><?php echo htmlspecialchars($fila["esAcreditada"]); ?></td>
                        <td><?php echo htmlspecialchars($fila["perfiles"]); ?></td>
                        <td><?php echo htmlspecialchars($fila["areaConocimiento"]); ?></td>
                        <td>
                            <div class="acciones">
                                <a class="btn-editar" href="editar.php?id=<?php echo $fila["id"]; ?>">Editar</a>
                                <a class="btn-eliminar" href="eliminar.php?id=<?php echo $fila["id"]; ?>" onclick="return confirm('¿Seguro que deseas eliminar este registro?');">Eliminar</a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="13" class="sin-registros">No hay registros todavía.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>

</body>
</html>

<?php
$conn->close();
?>