<?php
declare(strict_types=1);

$pageTitle = isset($pageTitle) ? (string) $pageTitle : 'Sistema Carrera Académica';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>
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
            padding: 22px 20px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.12);
        }

        .encabezado h1 {
            margin: 0;
            font-size: 32px;
        }

        .encabezado p {
            margin: 8px 0 0;
            font-size: 15px;
            opacity: 0.95;
        }

        .menu {
            background: #0b5ed7;
            padding: 10px 16px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .menu a {
            text-decoration: none;
            color: white;
            background: rgba(255,255,255,0.12);
            padding: 10px 14px;
            border-radius: 8px;
            font-weight: bold;
        }

        .contenedor {
            max-width: 1100px;
            margin: 30px auto;
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
        }

        .mensaje {
            padding: 14px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .error {
            background-color: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
        }

        .success {
            background-color: #e8f8ee;
            color: #146c43;
            border: 1px solid #badbcc;
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

        .btn-primario {
            background: #0d6efd;
            color: white;
        }

        .btn-exito {
            background: #198754;
            color: white;
        }

        .btn-alerta {
            background: #ffc107;
            color: #212529;
        }

        .btn-peligro {
            background: #dc3545;
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1200px;
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
        }

        tr:nth-child(even) {
            background-color: #f8fbff;
        }

        .acciones {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .pie {
            text-align: center;
            margin: 20px 0 30px;
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
                font-size: 26px;
            }
        }
    </style>
</head>
<body>