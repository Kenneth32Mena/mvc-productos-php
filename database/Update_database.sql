CREATE DATABASE IF NOT EXISTS mvc_productos
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE mvc_productos;

-- Elimina las tablas para permitir una instalación limpia del esquema completo.
DROP TABLE IF EXISTS productos;
DROP TABLE IF EXISTS categorias;

-- Categorías del catálogo.
CREATE TABLE categorias (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(250) NOT NULL,
    Descripcion VARCHAR(250) NOT NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Productos relacionados con categorías mediante una relación 1 a N.
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Id_Categoria INT NOT NULL,
    nombre VARCHAR(120) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    tipo ENUM('FISICO', 'DIGITAL') NOT NULL,
    peso DECIMAL(10,2) NULL,
    url_descarga VARCHAR(255) NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT chk_precio CHECK (precio > 0),
    CONSTRAINT chk_stock CHECK (stock >= 0),
    CONSTRAINT fk_productos_categorias
        FOREIGN KEY (Id_Categoria) REFERENCES categorias(ID)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Categorías iniciales.
INSERT INTO categorias (Nombre, Descripcion) VALUES
    ('Hardware', 'Periféricos y componentes físicos'),
    ('Software y Digital', 'Guías, cursos y productos digitales'),
    ('Periféricos Gaming', 'Mouse, teclados mecánicos y audífonos');

-- Productos iniciales asociados con sus categorías.
INSERT INTO productos
    (Id_Categoria, nombre, precio, stock, tipo, peso, url_descarga)
VALUES
    (1, 'Teclado mecánico', 55.00, 10, 'FISICO', 0.90, NULL),
    (2, 'Manual PDF de PHP', 8.50, 999, 'DIGITAL', NULL, 'https://ejemplo.local/manual.pdf'),
    (2, 'Juan Mecanico', 20.00, 1, 'DIGITAL', NULL, 'https:hola.com'),
    (1, 'Mouse Gamer RGB', 25.50, 15, 'FISICO', 0.25, NULL),
    (3, 'Monitor 144Hz 27 pulgadas', 280.00, 8, 'FISICO', 4.50, NULL),
    (3, 'Licencia Software Antivirus Pro', 35.00, 50, 'DIGITAL', NULL, 'https://downloads.local/antivirus-pro.lic');
