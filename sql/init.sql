CREATE TABLE area
(
    codigo_area INT(3) PRIMARY KEY
);

INSERT INTO area (codigo_area)
VALUES (1),
       (23),
       (26),
       (30),
       (31),
       (32),
       (33),
       (45),
       (147),
       (150);

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
