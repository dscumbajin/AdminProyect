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
	(1, 'admin', 'Darwin Cumbajin', '$2y$12$zBtBWe374pUdCgqQ2yeECO/4skNiuwVyhlQ5u6fak8h1eUIdOZu8C', '2020-10-29 12:19:45', 1),
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

-- Volcando datos para la tabla proyectos_db.cuentas: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `cuentas` DISABLE KEYS */;
INSERT INTO `cuentas` (`proyecto_id`, `registros_id`) VALUES
	(1, 1),
	(1, 2),
	(2, 3),
	(1, 7);
/*!40000 ALTER TABLE `cuentas` ENABLE KEYS */;

-- Volcando estructura para tabla proyectos_db.portafolios
DROP TABLE IF EXISTS `portafolios`;
CREATE TABLE IF NOT EXISTS `portafolios` (
  `portafolio_id` int(11) NOT NULL AUTO_INCREMENT,
  `area` varchar(50) NOT NULL DEFAULT '',
  `editado` datetime DEFAULT NULL,
  PRIMARY KEY (`portafolio_id`),
  UNIQUE KEY `area` (`area`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla proyectos_db.portafolios: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `portafolios` DISABLE KEYS */;
INSERT INTO `portafolios` (`portafolio_id`, `area`, `editado`) VALUES
	(1, 'Planta', NULL),
	(2, 'Terminado', NULL);
/*!40000 ALTER TABLE `portafolios` ENABLE KEYS */;

-- Volcando estructura para tabla proyectos_db.programas
DROP TABLE IF EXISTS `programas`;
CREATE TABLE IF NOT EXISTS `programas` (
  `programa_id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL DEFAULT '0',
  `editado` datetime DEFAULT NULL,
  PRIMARY KEY (`programa_id`),
  UNIQUE KEY `descripcion` (`descripcion`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla proyectos_db.programas: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `programas` DISABLE KEYS */;
INSERT INTO `programas` (`programa_id`, `descripcion`, `editado`) VALUES
	(1, 'Programa mejoras de planta', NULL),
	(2, 'Programa ampliación almacenamiento', NULL),
	(3, 'Programa incremento baterías fabricadas', NULL);
/*!40000 ALTER TABLE `programas` ENABLE KEYS */;

-- Volcando estructura para tabla proyectos_db.proyectos
DROP TABLE IF EXISTS `proyectos`;
CREATE TABLE IF NOT EXISTS `proyectos` (
  `proyecto_id` int(11) NOT NULL AUTO_INCREMENT,
  `detalle` varchar(255) NOT NULL,
  `objetivo_estrategico` varchar(100) NOT NULL,
  `presupuesto_inicial` double NOT NULL,
  `estado_neural` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `url_video` varchar(255) DEFAULT NULL,
  `portafolio_id` int(11) NOT NULL DEFAULT '0',
  `programa_id` int(11) NOT NULL,
  `editado` datetime DEFAULT NULL,
  PRIMARY KEY (`proyecto_id`),
  UNIQUE KEY `detalle` (`detalle`),
  KEY `FK_proyectos_portafolios` (`portafolio_id`),
  KEY `FK_proyectos_programas` (`programa_id`),
  CONSTRAINT `FK_proyectos_portafolios` FOREIGN KEY (`portafolio_id`) REFERENCES `portafolios` (`portafolio_id`),
  CONSTRAINT `FK_proyectos_programas` FOREIGN KEY (`programa_id`) REFERENCES `programas` (`programa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla proyectos_db.proyectos: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `proyectos` DISABLE KEYS */;
INSERT INTO `proyectos` (`proyecto_id`, `detalle`, `objetivo_estrategico`, `presupuesto_inicial`, `estado_neural`, `estado`, `url_video`, `portafolio_id`, `programa_id`, `editado`) VALUES
	(1, 'Mejora tanque de agua', 'mejorar', 3000, 'cerrado', 'cerrado', NULL, 1, 1, '2020-10-29 22:03:06'),
	(2, 'Prueba', 'Mejora', 10, 'activo', 'aprobado', NULL, 1, 1, '2020-10-29 21:12:07'),
	(6, '3', '3', 2000, 'activar', 'analisis', NULL, 2, 1, '2020-10-30 11:35:02');
/*!40000 ALTER TABLE `proyectos` ENABLE KEYS */;

-- Volcando estructura para tabla proyectos_db.registros
DROP TABLE IF EXISTS `registros`;
CREATE TABLE IF NOT EXISTS `registros` (
  `registros_id` int(11) NOT NULL AUTO_INCREMENT,
  `presupuesto` double(22,0) NOT NULL,
  `anio` date NOT NULL,
  `editado` datetime DEFAULT NULL,
  PRIMARY KEY (`registros_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla proyectos_db.registros: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `registros` DISABLE KEYS */;
INSERT INTO `registros` (`registros_id`, `presupuesto`, `anio`, `editado`) VALUES
	(1, 200, '2020-10-29', NULL),
	(2, 3000, '2021-10-29', NULL),
	(3, 1001, '2020-10-29', '2020-10-29 20:46:57'),
	(4, 50000, '2020-10-27', NULL),
	(5, 1000, '2020-10-27', NULL),
	(6, 30, '2020-10-27', NULL),
	(7, 6000, '2022-02-09', NULL),
	(8, 50000, '2020-10-27', NULL);
/*!40000 ALTER TABLE `registros` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
