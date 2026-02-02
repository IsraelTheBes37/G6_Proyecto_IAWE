CREATE DATABASE IF NOT EXISTS swiftpack CHARACTER SET utf8mb4;
USE swiftpack;

-- =====================
-- TABLA USUARIOS
-- =====================
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    correo VARCHAR(100) UNIQUE NOT NULL,
    clave VARCHAR(255) NOT NULL,
    rol ENUM('admin','cliente') NOT NULL DEFAULT 'cliente'
);

-- =====================
-- TABLA ESTADOS ENVÍO
-- =====================
CREATE TABLE estados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

-- =====================
-- TABLA ENVIOS
-- =====================
CREATE TABLE envios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    estado_id INT NOT NULL,
    descripcion TEXT,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cliente_id) REFERENCES usuarios(id),
    FOREIGN KEY (estado_id) REFERENCES estados(id)
);

-- =====================
-- INSERTS
-- =====================

-- ADMIN (TÚ)
INSERT INTO usuarios (nombre, apellido, correo, clave, rol)
VALUES ('Israel', 'Quishpe', 'admin@swiftpack.com', SHA2('admin123',256), 'admin');

-- CLIENTES
INSERT INTO usuarios (nombre, apellido, correo, clave, rol)
VALUES 
('Ana','López','ana@mail.com',SHA2('1234',256),'cliente'),
('Luis','García','luis@mail.com',SHA2('1234',256),'cliente'),
('Marta','Pérez','marta@mail.com',SHA2('1234',256),'cliente');

-- ESTADOS
INSERT INTO estados (nombre) VALUES
('En preparación'),
('En tránsito'),
('Entregado'),
('Incidencia');
