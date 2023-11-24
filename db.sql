DROP DATABASE IF EXISTS vetdb;
CREATE DATABASE vetdb;
USE vetdb;

CREATE TABLE cliente (
    idc INT PRIMARY KEY AUTO_INCREMENT,
    rut VARCHAR(9),
    nombre VARCHAR(255),
    correo VARCHAR(255),
    telefono VARCHAR(9)
);

CREATE TABLE ficha (
    idf INT PRIMARY KEY AUTO_INCREMENT,
    idc INT,
    ficha INT(5),
    raza VARCHAR(25),
    nombre VARCHAR(25),
    fecha DATE,
    servicio VARCHAR(30),
    detalle VARCHAR(255),
    FOREIGN KEY (idc) REFERENCES cliente(idc)  
);

CREATE TABLE personal (
    idp INT PRIMARY KEY AUTO_INCREMENT,
    rut VARCHAR(9),
    nombre VARCHAR(255),
    telefono VARCHAR(9),
    correo VARCHAR(255),
    servicio VARCHAR(255)
);

CREATE TABLE horario (
    idh INT PRIMARY KEY AUTO_INCREMENT,
    fecha DATE,
    bloque INT, 
    personal INT,
    mascota INT,
    FOREIGN KEY (personal) REFERENCES personal(idp),
    FOREIGN KEY (mascota) REFERENCES ficha(idf)
);


INSERT INTO cliente (rut, nombre, correo, telefono) VALUES
('123456789', 'Juan Pérez', 'juan@example.com', '987654321'),
('987654321', 'María Rodríguez', 'maria@example.com', '123456789'),
('567890123', 'Pedro Sánchez', 'pedro@example.com', '555555555'),
('345678901', 'Ana López', 'ana@example.com', '666666666'),
('789012345', 'Luis González', 'luis@example.com', '777777777');

INSERT INTO ficha (idc, ficha, raza, nombre, fecha, servicio, detalle) VALUES
(1, 1001, 'Labrador Retriever', 'Max', '2023-01-15', 'Vacunación', 'Vacuna anual'),
(2, 1002, 'Siamese', 'Luna', '2023-02-10', 'Control de peso', 'Luna está ganando peso rápidamente'),
(3, 1003, 'Golden Retriever', 'Buddy', '2023-03-20', 'Esterilización', 'Buddy necesita ser esterilizado'),
(4, 1004, 'Persian', 'Whiskers', '2023-04-05', 'Consulta médica', 'Problemas de alergia'),
(5, 1005, 'Dachshund', 'Coco', '2023-05-12', 'Vacunación', 'Coco necesita su segunda dosis');

INSERT INTO personal (rut, nombre, telefono, correo, servicio) VALUES
('234567890', 'Laura González', '888888888', 'laura@example.com', 'Veterinaria'),
('456789012', 'Carlos Martínez', '999999999', 'carlos@example.com', 'Asistente veterinario'),
('678901234', 'Ana Ramírez', '333333333', 'ana@example.com', 'Enfermera veterinaria'),
('890123456', 'Miguel Rodríguez', '444444444', 'miguel@example.com', 'Recepcionista'),
('012345678', 'Sofía Pérez', '222222222', 'sofia@example.com', 'Peluquería canina');

INSERT INTO horario (fecha, bloque, personal, mascota) VALUES
('2023-01-15', 1, 1, 1),
('2023-02-10', 2, 2, 2),
('2023-03-20', 3, 3, 3),
('2023-04-05', 1, 4, 4),
('2023-05-12', 2, 5, 5);
