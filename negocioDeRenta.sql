create database negocioDeRenta;

USE negocioDeRenta;

CREATE TABLE rol (
    rol_id int not null auto_increment,
    rol_nombre varchar(50),
    PRIMARY KEY (rol_id)
);


CREATE TABLE usuario (
    usuario_id int not null auto_increment,
    rol_id int not null,
    nombre varchar(255),
    clave varchar(255),
    primary key (usuario_id),
    foreign key (rol_id) references rol (rol_id)
);

CREATE TABLE inventario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    articulo VARCHAR(50) NOT NULL,
    cantidad INT NOT NULL DEFAULT 0,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE eventos (
    evento_id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_nombre VARCHAR(255) NOT NULL,
    telefono VARCHAR(20),
    direccion TEXT NOT NULL,
    mesas INT NOT NULL DEFAULT 0,
    sillas INT NOT NULL DEFAULT 0,
    manteles INT DEFAULT 0,
    flete DECIMAL(10,2) DEFAULT 0,
    total DECIMAL(10,2) NOT NULL,
    fecha_evento DATE NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fin TIME,
    usuario_id INT,
    FOREIGN KEY (usuario_id) REFERENCES usuario(usuario_id)
);

