-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.24-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para pablo
CREATE DATABASE IF NOT EXISTS `pablo` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `pablo`;

-- Volcando estructura para tabla pablo.alumno
CREATE TABLE IF NOT EXISTS `alumno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_alumno_cursos` (`id_curso`),
  KEY `FK_alumno_usuario` (`id_usuario`),
  CONSTRAINT `FK_alumno_cursos` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_alumno_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla pablo.cursos
CREATE TABLE IF NOT EXISTS `cursos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL DEFAULT 0,
  `id_profesor` int(11) NOT NULL DEFAULT 0,
  `titulo_curso` char(50) NOT NULL DEFAULT '0',
  `miniatura` char(50) NOT NULL DEFAULT '0',
  `precio` char(50) NOT NULL DEFAULT '0',
  `duracion` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `FK_cursos_empresas` (`id_empresa`),
  KEY `FK_cursos_profesor` (`id_profesor`) USING BTREE,
  CONSTRAINT `FK_cursos_empresas` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_cursos_profesor` FOREIGN KEY (`id_profesor`) REFERENCES `profesor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla pablo.empresa
CREATE TABLE IF NOT EXISTS `empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL DEFAULT 0,
  `nombre_empresa` varchar(50) NOT NULL DEFAULT '0',
  `miniatura` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla pablo.pagos
CREATE TABLE IF NOT EXISTS `pagos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_id` int(11) NOT NULL DEFAULT 0,
  `payment_type` varchar(150) NOT NULL DEFAULT '0',
  `order_id` int(11) NOT NULL DEFAULT 0,
  `id_alumno` int(11) NOT NULL DEFAULT 0,
  `id_curso` int(11) NOT NULL DEFAULT 0,
  `monto` int(11) NOT NULL DEFAULT 0,
  `fecha_pago` date NOT NULL,
  `fecha_caducidad` date NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `FK_pagos_alumno` (`id_alumno`),
  KEY `FK_pagos_cursos` (`id_curso`),
  CONSTRAINT `FK_pagos_alumno` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla pablo.profesor
CREATE TABLE IF NOT EXISTS `profesor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL DEFAULT 0,
  `id_usuario` int(11) NOT NULL DEFAULT 0,
  `nombre` varchar(50) NOT NULL DEFAULT '0',
  `apellido` varchar(50) NOT NULL DEFAULT '0',
  `telefono` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK__usuario` (`id_usuario`),
  KEY `FK_profesor_empresa` (`id_empresa`),
  CONSTRAINT `FK__usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_profesor_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla pablo.respaldos_videos
CREATE TABLE IF NOT EXISTS `respaldos_videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_videos` int(11) NOT NULL DEFAULT 0,
  `id_curso` int(11) NOT NULL DEFAULT 0,
  `id_empresa` int(11) NOT NULL DEFAULT 0,
  `id_profesor` int(11) NOT NULL DEFAULT 0,
  `link` varchar(200) NOT NULL DEFAULT '0',
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla pablo.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL DEFAULT '0',
  `pass` varchar(50) NOT NULL DEFAULT '0',
  `tipo` enum('USUARIO','ADMIN','PROFESOR') NOT NULL DEFAULT 'USUARIO',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla pablo.videos
CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_profesor` int(11) NOT NULL DEFAULT 0,
  `id_curso` int(11) NOT NULL DEFAULT 0,
  `id_empresa` int(11) NOT NULL DEFAULT 0,
  `id_video` varchar(50) NOT NULL DEFAULT '0',
  `tipo` enum('Y','V') NOT NULL DEFAULT 'V',
  `titulo_video` varchar(50) NOT NULL DEFAULT '0',
  `descripcion` varchar(50) NOT NULL DEFAULT '0',
  `miniatura` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_videos_empresa` (`id_empresa`),
  KEY `FK_videos_cursos` (`id_curso`),
  KEY `FK_videos_profesor` (`id_profesor`),
  CONSTRAINT `FK_videos_cursos` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_videos_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_videos_profesor` FOREIGN KEY (`id_profesor`) REFERENCES `profesor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para disparador pablo.respaldoVideos
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `respaldoVideos` AFTER DELETE ON `videos` FOR EACH ROW BEGIN
INSERT INTO respaldos_videos (id_videos,id_curso,id_empresa,id_profesor,link,fecha)
VALUES (OLD.id, OLD.id_curso,OLD.id_empresa,OLD.id_profesor,OLD.id_video,NOW());
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
