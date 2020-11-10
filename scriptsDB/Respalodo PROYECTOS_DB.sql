-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.24 - MySQL Community Server (GPL)
-- SO del servidor:              Win32
-- HeidiSQL Versión:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para proyectos_db
DROP DATABASE IF EXISTS `proyectos_db`;
CREATE DATABASE IF NOT EXISTS `proyectos_db` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `proyectos_db`;

-- Volcando estructura para tabla proyectos_db.admins
DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `editado` datetime DEFAULT NULL,
  `nivel` int(1) NOT NULL,
  PRIMARY KEY (`id_admin`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla proyectos_db.admins: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` (`id_admin`, `usuario`, `nombre`, `password`, `editado`, `nivel`) VALUES
	(1, 'admin', 'SuperUsuario', '$2y$12$zBtBWe374pUdCgqQ2yeECO/4skNiuwVyhlQ5u6fak8h1eUIdOZu8C', '2020-10-29 12:19:45', 1),
	(2, 'baterias', 'Baterias Ecuador', '$2y$12$QLq0bitYq8NBlna3GGEl8.raUHWr8uXVmx28KuQS6Rdmn8K0nRtW2', '2020-10-27 18:59:30', 0),
	(3, 'Genesis', 'Genesis', '$2y$12$z9wS/h1I88JuHu7JhQzYUOJue3vjlVTM5cjf7N5VM0YE9RYz4t5Tm', '2020-10-29 11:17:55', 1);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;

-- Volcando estructura para tabla proyectos_db.cuentas
DROP TABLE IF EXISTS `cuentas`;
CREATE TABLE IF NOT EXISTS `cuentas` (
  `proyecto_id` int(11) NOT NULL DEFAULT '0',
  `registros_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`proyecto_id`,`registros_id`),
  KEY `FK_cuentas_registros` (`registros_id`),
  CONSTRAINT `FK_cuentas_proyectos` FOREIGN KEY (`proyecto_id`) REFERENCES `proyectos` (`proyecto_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_cuentas_registros` FOREIGN KEY (`registros_id`) REFERENCES `registros` (`registros_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla proyectos_db.cuentas: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `cuentas` DISABLE KEYS */;
INSERT INTO `cuentas` (`proyecto_id`, `registros_id`) VALUES
	(1, 1);
/*!40000 ALTER TABLE `cuentas` ENABLE KEYS */;

-- Volcando estructura para tabla proyectos_db.estados
DROP TABLE IF EXISTS `estados`;
CREATE TABLE IF NOT EXISTS `estados` (
  `estado_id` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`estado_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla proyectos_db.estados: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `estados` DISABLE KEYS */;
INSERT INTO `estados` (`estado_id`, `estado`) VALUES
	(1, 'Análisis'),
	(2, 'Aprobado'),
	(3, 'Proceso'),
	(4, 'Entrega'),
	(5, 'Cerrado');
/*!40000 ALTER TABLE `estados` ENABLE KEYS */;

-- Volcando estructura para tabla proyectos_db.portafolios
DROP TABLE IF EXISTS `portafolios`;
CREATE TABLE IF NOT EXISTS `portafolios` (
  `portafolio_id` int(11) NOT NULL AUTO_INCREMENT,
  `area` varchar(50) NOT NULL DEFAULT '',
  `editado` datetime DEFAULT NULL,
  PRIMARY KEY (`portafolio_id`),
  UNIQUE KEY `area` (`area`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla proyectos_db.portafolios: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `portafolios` DISABLE KEYS */;
INSERT INTO `portafolios` (`portafolio_id`, `area`, `editado`) VALUES
	(1, 'Planta', NULL),
	(2, 'Terminado', NULL),
	(3, 'Bodega', NULL),
	(4, 'Ensamblaje', NULL),
	(5, 'Fabricación de placas', '2020-11-04 07:29:33'),
	(6, 'Formacón', NULL),
	(7, 'Occidental', NULL),
	(8, 'Polipropileno', NULL),
	(9, 'Reciclaje', NULL);
/*!40000 ALTER TABLE `portafolios` ENABLE KEYS */;

-- Volcando estructura para tabla proyectos_db.programas
DROP TABLE IF EXISTS `programas`;
CREATE TABLE IF NOT EXISTS `programas` (
  `programa_id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL DEFAULT '0',
  `editado` datetime DEFAULT NULL,
  PRIMARY KEY (`programa_id`),
  UNIQUE KEY `descripcion` (`descripcion`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla proyectos_db.programas: ~11 rows (aproximadamente)
/*!40000 ALTER TABLE `programas` DISABLE KEYS */;
INSERT INTO `programas` (`programa_id`, `descripcion`, `editado`) VALUES
	(1, 'Programa mejoras de planta', NULL),
	(2, 'Programa ampliación almacenamiento', NULL),
	(3, 'Programa incremento baterías fabricadas', NULL),
	(4, 'Programa comercial', NULL),
	(5, 'Programa de ampliación bodega', NULL),
	(6, 'Programa de ampliación reciclaje', NULL),
	(7, 'Programa de creación de planta', NULL),
	(8, 'Programa de mejora reciclaje', NULL),
	(9, 'Programa mejora en la fabricación de placas', NULL),
	(10, 'Programa mejoras carga y descarga', NULL),
	(11, 'Programa remediación ambiental', NULL);
/*!40000 ALTER TABLE `programas` ENABLE KEYS */;

-- Volcando estructura para tabla proyectos_db.proyectos
DROP TABLE IF EXISTS `proyectos`;
CREATE TABLE IF NOT EXISTS `proyectos` (
  `proyecto_id` int(11) NOT NULL AUTO_INCREMENT,
  `inicio` date NOT NULL,
  `detalle` varchar(255) NOT NULL,
  `objetivo_estrategico` varchar(100) NOT NULL,
  `presupuesto_inicial` double NOT NULL,
  `estado_neural` varchar(50) NOT NULL,
  `url_video` varchar(255) DEFAULT NULL,
  `url_documento` varchar(255) DEFAULT NULL,
  `cuenta` varchar(255) DEFAULT '0',
  `portafolio_id` int(11) NOT NULL DEFAULT '0',
  `programa_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `editado` datetime DEFAULT NULL,
  PRIMARY KEY (`proyecto_id`),
  UNIQUE KEY `detalle` (`detalle`),
  KEY `FK_proyectos_portafolios` (`portafolio_id`),
  KEY `FK_proyectos_programas` (`programa_id`),
  KEY `FK_proyectos_estados` (`estado_id`),
  CONSTRAINT `FK_proyectos_estados` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`estado_id`),
  CONSTRAINT `FK_proyectos_portafolios` FOREIGN KEY (`portafolio_id`) REFERENCES `portafolios` (`portafolio_id`),
  CONSTRAINT `FK_proyectos_programas` FOREIGN KEY (`programa_id`) REFERENCES `programas` (`programa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla proyectos_db.proyectos: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `proyectos` DISABLE KEYS */;
INSERT INTO `proyectos` (`proyecto_id`, `inicio`, `detalle`, `objetivo_estrategico`, `presupuesto_inicial`, `estado_neural`, `url_video`, `url_documento`, `cuenta`, `portafolio_id`, `programa_id`, `estado_id`, `editado`) VALUES
	(1, '2020-01-10', 'Planta Reciclaje (Itulcachi)', 'Utilizar la innovación para mejorar los procesos y los productos.', 2000, 'Cerrado', '', 'Logo-baterias.pdf', '1010', 1, 7, 2, '2020-11-09 20:13:30');
/*!40000 ALTER TABLE `proyectos` ENABLE KEYS */;

-- Volcando estructura para tabla proyectos_db.proyecto_estado
DROP TABLE IF EXISTS `proyecto_estado`;
CREATE TABLE IF NOT EXISTS `proyecto_estado` (
  `id_pe` int(11) NOT NULL AUTO_INCREMENT,
  `proyecto_id` int(11) NOT NULL DEFAULT '0',
  `estado_id` int(11) NOT NULL DEFAULT '0',
  `comentario` varchar(255) DEFAULT NULL,
  `editado` datetime DEFAULT NULL,
  PRIMARY KEY (`id_pe`),
  KEY `FK_proyecto_estado_estados` (`estado_id`),
  KEY `FK_proyecto_estado_proyectos` (`proyecto_id`),
  CONSTRAINT `FK_proyecto_estado_estados` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`estado_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_proyecto_estado_proyectos` FOREIGN KEY (`proyecto_id`) REFERENCES `proyectos` (`proyecto_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla proyectos_db.proyecto_estado: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `proyecto_estado` DISABLE KEYS */;
INSERT INTO `proyecto_estado` (`id_pe`, `proyecto_id`, `estado_id`, `comentario`, `editado`) VALUES
	(1, 1, 2, ' ', '2020-11-09 20:13:30');
/*!40000 ALTER TABLE `proyecto_estado` ENABLE KEYS */;

-- Volcando estructura para tabla proyectos_db.registros
DROP TABLE IF EXISTS `registros`;
CREATE TABLE IF NOT EXISTS `registros` (
  `registros_id` int(11) NOT NULL AUTO_INCREMENT,
  `presupuesto` double(22,0) NOT NULL,
  `anio` date NOT NULL,
  `editado` datetime DEFAULT NULL,
  PRIMARY KEY (`registros_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla proyectos_db.registros: ~16 rows (aproximadamente)
/*!40000 ALTER TABLE `registros` DISABLE KEYS */;
INSERT INTO `registros` (`registros_id`, `presupuesto`, `anio`, `editado`) VALUES
	(1, 2000, '2020-05-17', '2020-11-08 20:14:46'),
	(2, 2000, '2012-01-10', '2020-11-04 09:57:12'),
	(3, 100, '2020-01-08', NULL),
	(4, 100, '2020-01-08', NULL),
	(5, 100, '2020-01-08', NULL),
	(6, 100, '2020-01-08', NULL),
	(10, 100, '2020-01-22', NULL),
	(11, 100, '2020-02-22', NULL),
	(14, 10, '2020-12-25', NULL),
	(15, 10, '2020-01-08', NULL),
	(16, 200, '2020-11-08', NULL),
	(17, 600, '2020-11-09', NULL),
	(18, 20, '2020-11-10', NULL),
	(19, 20, '2020-01-08', NULL),
	(20, 40, '2020-01-08', NULL),
	(21, 100, '2020-11-08', NULL),
	(22, 100, '2020-01-08', NULL);
/*!40000 ALTER TABLE `registros` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
