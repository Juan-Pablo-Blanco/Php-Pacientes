-- Se crea la base de datos PacientesDB --

CREATE DATABASE IF NOT EXISTS `pacientes_db`; 

-- Se selecciona la base de datos PacientesDB --

USE `pacientes_db`;


-- Se crea la tabla de Pacientes --

CREATE TABLE `pacientes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `adulto_responsable` varchar(100) DEFAULT NULL,
  `motivo_consulta` text DEFAULT NULL,
  
  PRIMARY KEY (`id`)

) 

ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla Pacientes';



-- Se crea la tabla de Turnos --
CREATE TABLE `turnos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `paciente_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_turno` date NOT NULL,
  `hora_turno` time NOT NULL,
  `observaciones` text DEFAULT NULL,
  `obra_social` varchar(30) DEFAULT NULL,

  PRIMARY KEY (`id`),
  
  KEY `fk_paciente_turno` (`paciente_id`),
  
  CONSTRAINT `fk_paciente_turno` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE

) 

ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla Turnos';