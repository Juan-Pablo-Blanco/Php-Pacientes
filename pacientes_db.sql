CREATE TABLE `pacientes` (
  `id` INT(255) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `apellido` VARCHAR(50) NOT NULL,
  `fecha_nacimiento` DATE NOT NULL,
  `telefono` BIGINT NOT NULL,
  `adulto_responsable` VARCHAR(100) DEFAULT NULL,
  `motivo_consulta` TEXT DEFAULT NULL,

  PRIMARY KEY (`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabla Pacientes';
