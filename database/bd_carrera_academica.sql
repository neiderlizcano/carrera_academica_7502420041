CREATE DATABASE IF NOT EXISTS bd_carrera_academica
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

USE bd_carrera_academica;

CREATE TABLE IF NOT EXISTS carrera_academica (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    numCreditos INT NOT NULL,
    numAsignaturas INT NOT NULL,
    numSemestres INT NOT NULL,
    nivelFormacion VARCHAR(100) NOT NULL,
    titulo VARCHAR(150) NOT NULL,
    valorSemestre DECIMAL(12,2) NOT NULL,
    universidad VARCHAR(150) NOT NULL,
    esAcreditada VARCHAR(10) NOT NULL,
    perfiles TEXT NOT NULL,
    areaConocimiento VARCHAR(150) NOT NULL
);