<?php
declare(strict_types=1);

final class Connection
{
    public static function get(): mysqli
    {
        $servidor = 'localhost';
        $usuario = 'root';
        $contrasena = '';
        $baseDatos = 'bd_carrera_academica';

        $conn = new mysqli($servidor, $usuario, $contrasena, $baseDatos);

        if ($conn->connect_error) {
            throw new RuntimeException('Error de conexión: ' . $conn->connect_error);
        }

        $conn->set_charset('utf8mb4');

        return $conn;
    }
}