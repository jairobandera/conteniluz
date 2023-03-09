-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.24-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando estructura para tabla pablo.alumno
CREATE TABLE IF NOT EXISTS `alumno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `pago` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`id`),
  KEY `FK_alumno_cursos` (`id_curso`),
  KEY `FK_alumno_usuario` (`id_usuario`),
  CONSTRAINT `FK_alumno_cursos` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_alumno_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla pablo.alumno: ~3 rows (aproximadamente)
INSERT INTO `alumno` (`id`, `id_usuario`, `id_curso`, `pago`) VALUES
	(18, 77, 47, 'N'),
	(19, 86, 49, 'N'),
	(20, 77, 49, 'Y');

-- Volcando estructura para tabla pablo.cursos
CREATE TABLE IF NOT EXISTS `cursos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL DEFAULT 0,
  `id_profesor` int(11) NOT NULL DEFAULT 0,
  `titulo_curso` char(50) NOT NULL DEFAULT '0',
  `miniatura` char(250) NOT NULL DEFAULT '0',
  `dolares` char(50) NOT NULL DEFAULT '0',
  `pesos` char(50) NOT NULL DEFAULT '0',
  `duracion` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `FK_cursos_empresas` (`id_empresa`),
  KEY `FK_cursos_profesor` (`id_profesor`) USING BTREE,
  CONSTRAINT `FK_cursos_empresas` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_cursos_profesor` FOREIGN KEY (`id_profesor`) REFERENCES `profesor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla pablo.cursos: ~3 rows (aproximadamente)
INSERT INTO `cursos` (`id`, `id_empresa`, `id_profesor`, `titulo_curso`, `miniatura`, `dolares`, `pesos`, `duracion`) VALUES
	(47, 16, 28, 'Titulo', 'img1.jpg', '5000', '150', 1),
	(48, 16, 28, 'Titulo2', 'img2.jpg', '30', '50', 1),
	(49, 16, 28, 'Titulo3', 'img3.jpg', '55', '300', 1);

-- Volcando estructura para tabla pablo.empresa
CREATE TABLE IF NOT EXISTS `empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL DEFAULT 0,
  `nombre_empresa` varchar(50) NOT NULL DEFAULT '0',
  `miniatura` varchar(250) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla pablo.empresa: ~1 rows (aproximadamente)
INSERT INTO `empresa` (`id`, `id_usuario`, `nombre_empresa`, `miniatura`) VALUES
	(16, 76, 'Pablo Bandera', 'img1.jpg');

-- Volcando estructura para tabla pablo.pagos
CREATE TABLE IF NOT EXISTS `pagos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_id` varchar(200) NOT NULL DEFAULT '0',
  `payment_type` varchar(150) NOT NULL DEFAULT '0',
  `order_id` varchar(200) NOT NULL DEFAULT '0',
  `id_alumno` int(11) NOT NULL DEFAULT 0,
  `id_curso` int(11) NOT NULL DEFAULT 0,
  `monto` int(11) NOT NULL DEFAULT 0,
  `fecha_pago` date NOT NULL,
  `fecha_caducidad` date NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT '',
  `tipo` enum('PAYPAL','MERCADOPAGO') NOT NULL DEFAULT 'MERCADOPAGO',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla pablo.pagos: ~0 rows (aproximadamente)

-- Volcando estructura para tabla pablo.profesor
CREATE TABLE IF NOT EXISTS `profesor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL DEFAULT 0,
  `nombre` varchar(50) NOT NULL DEFAULT '0',
  `apellido` varchar(50) NOT NULL DEFAULT '0',
  `telefono` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK__usuario` (`id_usuario`),
  CONSTRAINT `FK__usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla pablo.profesor: ~1 rows (aproximadamente)
INSERT INTO `profesor` (`id`, `id_usuario`, `nombre`, `apellido`, `telefono`) VALUES
	(28, 76, 'pablo', 'bandera', '099999');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla pablo.respaldos_videos: ~0 rows (aproximadamente)
INSERT INTO `respaldos_videos` (`id`, `id_videos`, `id_curso`, `id_empresa`, `id_profesor`, `link`, `fecha`) VALUES
	(2, 8, 48, 16, 28, '739209276', '2023-01-17 18:43:45'),
	(3, 9, 49, 16, 28, '739209276', '2023-01-17 18:43:45');

-- Volcando estructura para tabla pablo.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL DEFAULT '0',
  `pass` varchar(50) NOT NULL DEFAULT '0',
  `tipo` enum('USUARIO','ADMIN','PROFESOR') NOT NULL DEFAULT 'USUARIO',
  `nombre` varchar(200) NOT NULL,
  `apellido` varchar(200) NOT NULL,
  `telefono` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla pablo.usuario: ~4 rows (aproximadamente)
INSERT INTO `usuario` (`id`, `usuario`, `pass`, `tipo`, `nombre`, `apellido`, `telefono`) VALUES
	(48, 'admin', '202cb962ac59075b964b07152d234b70', 'ADMIN', 'jairo', 'bandera', '97961228'),
	(76, 'profesor', '202cb962ac59075b964b07152d234b70', 'PROFESOR', 'pablo', 'bandera', '099999'),
	(77, 'usuario', '202cb962ac59075b964b07152d234b70', 'USUARIO', 'jairo', 'bandera', '47221865'),
	(86, 'jairo', '202cb962ac59075b964b07152d234b70', 'USUARIO', 'jairo', 'bandera', '47221865');

-- Volcando estructura para tabla pablo.videos
CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_profesor` int(11) NOT NULL DEFAULT 0,
  `id_curso` int(11) NOT NULL DEFAULT 0,
  `id_empresa` int(11) NOT NULL DEFAULT 0,
  `id_video` varchar(150) NOT NULL DEFAULT '0',
  `tipo` enum('Y','V') NOT NULL DEFAULT 'V',
  `es_presentacion` enum('Y','N') NOT NULL DEFAULT 'N',
  `titulo_video` varchar(150) NOT NULL DEFAULT '0',
  `descripcion` varchar(500) NOT NULL DEFAULT '',
  `miniatura` varchar(150) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_videos_empresa` (`id_empresa`),
  KEY `FK_videos_cursos` (`id_curso`),
  KEY `FK_videos_profesor` (`id_profesor`),
  CONSTRAINT `FK_videos_cursos` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_videos_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_videos_profesor` FOREIGN KEY (`id_profesor`) REFERENCES `profesor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla pablo.videos: ~1 rows (aproximadamente)
INSERT INTO `videos` (`id`, `id_profesor`, `id_curso`, `id_empresa`, `id_video`, `tipo`, `es_presentacion`, `titulo_video`, `descripcion`, `miniatura`) VALUES
	(7, 28, 47, 16, '739209276', 'V', 'Y', 'Titulo del Video', 'Lorem Impsum', '2022-10-18-15-17-17.png');

-- Volcando estructura para disparador pablo.respaldoVideos
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `respaldoVideos` AFTER DELETE ON `videos` FOR EACH ROW BEGIN
INSERT INTO respaldos_videos (id_videos,id_curso,id_empresa,id_profesor,link,fecha)
VALUES (OLD.id, OLD.id_curso,OLD.id_empresa,OLD.id_profesor,OLD.id_video,NOW());
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
