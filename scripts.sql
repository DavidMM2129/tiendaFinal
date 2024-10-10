-- Creación de la base de datos
CREATE DATABASE IF NOT EXISTS tienda_ropa;
USE tienda_ropa;

-- Creación de la tabla de marcas
CREATE TABLE IF NOT EXISTS marcas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    pais_origen VARCHAR(50)
);

-- Creación de la tabla de prendas
CREATE TABLE IF NOT EXISTS prendas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    precio DECIMAL(10, 2),
    marca_id INT,
    FOREIGN KEY (marca_id) REFERENCES marcas(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

-- Creación de la tabla de ventas
CREATE TABLE IF NOT EXISTS ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    prenda_id INT,
    cantidad INT,
    fecha_venta DATE,
    FOREIGN KEY (prenda_id) REFERENCES prendas(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

-- Inserción de datos en la tabla marcas
INSERT INTO marcas (nombre, pais_origen)
VALUES 
('Marca A', 'España'),
('Marca B', 'Francia'),
('Marca C', 'Italia'),
('Marca D', 'Alemania'),
('Marca E', 'Estados Unidos'),
('Marca F', 'Reino Unido'),
('Marca G', 'México'),
('Marca H', 'Brasil'),
('Marca I', 'Japón'),
('Marca J', 'Canadá');

-- Inserción de datos en la tabla prendas
INSERT INTO prendas (nombre, precio, marca_id)
VALUES
('Camiseta', 19.99, 1),
('Pantalones', 39.99, 2),
('Chaqueta', 59.99, 3),
('Zapatos', 89.99, 4),
('Sombrero', 14.99, 5),
('Bufanda', 9.99, 6),
('Falda', 29.99, 7),
('Blusa', 24.99, 8),
('Cinturón', 11.99, 9),
('Calcetines', 4.99, 10),
('Vestido', 49.99, 2),
('Chaleco', 34.99, 3),
('Guantes', 15.99, 4),
('Reloj', 99.99, 5),
('Bolso', 45.99, 6),
('Traje', 199.99, 7),
('Gorra', 12.99, 8),
('Jeans', 44.99, 9),
('Camisa', 22.99, 1),
('Jersey', 29.99, 10);

-- Inserción de datos en la tabla ventas
INSERT INTO ventas (prenda_id, cantidad, fecha_venta)
VALUES
(1, 2, '2024-10-01'),
(2, 1, '2024-10-02'),
(3, 3, '2024-10-03'),
(4, 1, '2024-10-04'),
(5, 2, '2024-10-05'),
(6, 1, '2024-10-06'),
(7, 3, '2024-10-07'),
(8, 1, '2024-10-08'),
(9, 5, '2024-10-09'),
(10, 4, '2024-10-10'),
(11, 2, '2024-10-11'),
(12, 3, '2024-10-12'),
(13, 1, '2024-10-13'),
(14, 2, '2024-10-14'),
(15, 1, '2024-10-15'),
(16, 4, '2024-10-16'),
(17, 1, '2024-10-17'),
(18, 5, '2024-10-18'),
(19, 3, '2024-10-19'),
(20, 2, '2024-10-20');

-- Eliminación de un dato (ejemplo: eliminar prenda "Pantalones")
DELETE FROM prendas WHERE nombre = 'Pantalones';

-- Actualización de un dato (ejemplo: actualizar el precio de "Chaqueta")
UPDATE prendas SET precio = 69.99 WHERE nombre = 'Chaqueta';

-- Consulta: Obtener la cantidad vendida de prendas por fecha específica
SELECT prenda_id, SUM(cantidad) AS total_vendido
FROM ventas
WHERE fecha_venta = '2024-10-01'
GROUP BY prenda_id;

-- Creación de la vista para obtener la lista de todas las marcas que tienen al menos una venta
CREATE VIEW marcas_con_ventas AS
SELECT DISTINCT m.nombre
FROM marcas m
JOIN prendas p ON m.id = p.marca_id
JOIN ventas v ON p.id = v.prenda_id;

-- Creación de la vista para obtener prendas vendidas y su cantidad restante en stock (suponiendo un stock inicial)
CREATE VIEW prendas_con_stock AS
SELECT p.nombre, SUM(v.cantidad) AS cantidad_vendida
FROM prendas p
LEFT JOIN ventas v ON p.id = v.prenda_id
GROUP BY p.nombre;

-- Creación de la vista para obtener las 5 marcas más vendidas y su cantidad de ventas
CREATE VIEW top_5_marcas AS
SELECT m.nombre, SUM(v.cantidad) AS total_ventas
FROM marcas m
JOIN prendas p ON m.id = p.marca_id
JOIN ventas v ON p.id = v.prenda_id
GROUP BY m.nombre
ORDER BY total_ventas DESC
LIMIT 5;
