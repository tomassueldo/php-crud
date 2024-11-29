CREATE TABLE area
(
    codigo_area INT(3) PRIMARY KEY
);

INSERT INTO area (codigo_area)
VALUES (101),
       (102),
       (103),
       (204),
       (215),
       (216),
       (355),
       (384),
       (399),
       (400);

CREATE TABLE formulario
(
    id        INT AUTO_INCREMENT PRIMARY KEY,
    nombre    VARCHAR(50),
    apellido  VARCHAR(50),
    documento VARCHAR(10) UNIQUE,
    area      INT,
    telefono  VARCHAR(10),
    email     VARCHAR(100) UNIQUE,
    FOREIGN KEY (area) REFERENCES area (codigo_area)
);
