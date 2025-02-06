CREATE DATABASE IF NOT EXISTS universidad;
USE universidad;

-- Tabla principal para residentes y alumnos
CREATE TABLE residentes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    edad INT NOT NULL,
    correo VARCHAR(100) UNIQUE NOT NULL,
    telefono VARCHAR(15) NOT NULL,
    numero_habitacion INT NOT NULL
);

-- Tabla secundaria para información adicional de estudiantes
CREATE TABLE estudiantes (
    id INT PRIMARY KEY,
    nombre_curso VARCHAR(100) NOT NULL,
    matricula INT NOT NULL,
    clave_acceso VARCHAR(255) NOT NULL,
    FOREIGN KEY (id) REFERENCES residentes(id) ON DELETE CASCADE
);
