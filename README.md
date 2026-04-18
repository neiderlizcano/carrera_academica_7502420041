# Carrera Académica 7502420041

Aplicación web en PHP orientado a objetos para la gestión de carreras académicas, desarrollada aplicando DDD y Arquitectura Hexagonal, siguiendo las guías de aprendizaje del curso.

## Objetivo

Implementar un sistema web con autenticación y CRUDL para la entidad **Carrera Académica**, manteniendo separación por capas y responsabilidades.

## Arquitectura aplicada

El proyecto está organizado con enfoque de:

- **DDD**
- **Arquitectura Hexagonal**
- **Entrypoint web centralizado**
- **Adaptadores de persistencia**
- **Puertos de entrada y salida**
- **Servicios de aplicación**
- **DTOs y mappers web**

## Estructura principal

```text
Common/
  ClassLoader.php
  DependencyInjection.php

Infrastructure/
  Entrypoints/Web/
    Config/
      WebRoutes.php
    Controllers/
      Dto/
      Mapper/
      CarreraAcademicaController.php
    Presentation/
      Views/
      Flash.php
      View.php

public/
  index.php

src/CarreraAcademica/
  Application/
    Ports/
      In/
      Out/
    Services/
      Dto/
        Commands/
        Queries/
      Mappers/
  Domain/
    Models/
    ValueObjects/
    Exceptions/
  Infrastructure/
    Adapters/Persistence/MySQL/
      Config/
      Dto/
      Entity/
      Mapper/
      Repository/

database/
  bd_carrera_academica.sql