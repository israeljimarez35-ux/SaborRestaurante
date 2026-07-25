CREATE DATABASE IF NOT EXISTS sabor_restaurante;

USE sabor_restaurante;

CREATE TABLE usuarios(

id INT AUTO_INCREMENT PRIMARY KEY,

nombre VARCHAR(100) NOT NULL,

correo VARCHAR(100) NOT NULL UNIQUE,

telefono VARCHAR(10) NOT NULL,

password VARCHAR(255) NOT NULL,

fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);


CREATE TABLE productos(

id_producto INT AUTO_INCREMENT PRIMARY KEY,

nombre VARCHAR(100) NOT NULL,

descripcion TEXT,

precio DECIMAL(10,2) NOT NULL,

imagen VARCHAR(200),

categoria VARCHAR(50)

);

CREATE TABLE carrito(

id_carrito INT AUTO_INCREMENT PRIMARY KEY,

id_usuario INT NOT NULL,

id_producto INT NOT NULL,

cantidad INT DEFAULT 1,

FOREIGN KEY(id_usuario)
REFERENCES usuarios(id),

FOREIGN KEY(id_producto)
REFERENCES productos(id_producto)

);

CREATE TABLE pedidos(

id_pedido INT AUTO_INCREMENT PRIMARY KEY,

id_usuario INT NOT NULL,

total DECIMAL(10,2),

fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

estado VARCHAR(30) DEFAULT 'Pendiente',

FOREIGN KEY(id_usuario)
REFERENCES usuarios(id)

);

CREATE TABLE detalle_pedido(

id_detalle INT AUTO_INCREMENT PRIMARY KEY,

id_pedido INT,

id_producto INT,

cantidad INT,

precio DECIMAL(10,2),

FOREIGN KEY(id_pedido)
REFERENCES pedidos(id_pedido),

FOREIGN KEY(id_producto)
REFERENCES productos(id_producto)

);

CREATE TABLE reservas(

id_reserva INT AUTO_INCREMENT PRIMARY KEY,

id_usuario INT,

fecha DATE,

hora TIME,

personas INT,

telefono VARCHAR(10),

estado VARCHAR(30) DEFAULT 'Pendiente',

FOREIGN KEY(id_usuario)
REFERENCES usuarios(id)

);