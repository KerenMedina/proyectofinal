-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         10.1.36-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para proyecto_final
CREATE DATABASE IF NOT EXISTS `proyecto_final` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `proyecto_final`;

-- Volcando estructura para tabla proyecto_final.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `idAdmin` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(50) NOT NULL,
  `contrasenya` varchar(50) NOT NULL,
  PRIMARY KEY (`idAdmin`),
  UNIQUE KEY `nick` (`nick`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyecto_final.admin: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`idAdmin`, `nick`, `contrasenya`) VALUES
	(1, 'keren', '123456789');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Volcando estructura para tabla proyecto_final.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(50) NOT NULL,
  `contrasenya` varchar(50) NOT NULL,
  `DNI` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `telefono` int(11) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  PRIMARY KEY (`idCliente`),
  UNIQUE KEY `nick` (`nick`),
  UNIQUE KEY `DNI` (`DNI`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyecto_final.clientes: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` (`idCliente`, `nick`, `contrasenya`, `DNI`, `email`, `imagen`, `telefono`, `direccion`, `ciudad`) VALUES
	(1, 'mario', '12345678', '82974304X', 'mario@correo.com', '1.png', 741852963, 'ad', 'asdf'),
	(2, 'andrea', '123456789', '48277815X', 'andrea@correo.com', '2.png', 987456321, 'dafd', 'asfd');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;

-- Volcando estructura para tabla proyecto_final.guias
CREATE TABLE IF NOT EXISTS `guias` (
  `idGuia` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(50) NOT NULL,
  `contrasenya` varchar(50) NOT NULL,
  `DNI` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefono` int(11) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `idioma1` varchar(50) NOT NULL,
  `idioma2` varchar(50) NOT NULL,
  `idioma3` varchar(50) NOT NULL,
  PRIMARY KEY (`idGuia`),
  UNIQUE KEY `nick` (`nick`),
  UNIQUE KEY `DNI` (`DNI`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyecto_final.guias: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `guias` DISABLE KEYS */;
INSERT INTO `guias` (`idGuia`, `nick`, `contrasenya`, `DNI`, `email`, `telefono`, `imagen`, `idioma1`, `idioma2`, `idioma3`) VALUES
	(1, 'andrea', '12345678', '48277815X', 'andrea@correo.com', 657894012, '1.png', 'espanyol', 'ingles', 'frances'),
	(2, 'pablo', '12345678', '33551306X', 'pablo@correo.com', 693582471, '2.png', 'frances', 'italiano', ''),
	(3, 'pepe', '12345678', '45922245P', 'pepe@correo.com', 687459123, '3.png', 'ingles', 'aleman', 'frances'),
	(10, 'jose', '12345678', '06916513E', 'antonio@correo.com', 654789321, '10.png', 'ingles', 'aleman', 'Italiano'),
	(11, 'paco', '12345678', '', 'paco@correo.com', 687459145, '11.png', 'ingles', 'espanyol', ''),
	(16, 'sandra', '12345678', '91654732P', 'sandra@correo.com', 689574123, '16.png', 'espanyol', '', '');
/*!40000 ALTER TABLE `guias` ENABLE KEYS */;

-- Volcando estructura para tabla proyecto_final.horarios
CREATE TABLE IF NOT EXISTS `horarios` (
  `idHorario` int(11) NOT NULL AUTO_INCREMENT,
  `idTour` int(11) DEFAULT NULL,
  `horario` datetime DEFAULT NULL,
  PRIMARY KEY (`idHorario`),
  KEY `idTour_horario` (`idTour`),
  CONSTRAINT `idTour_horario` FOREIGN KEY (`idTour`) REFERENCES `tour` (`idTour`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyecto_final.horarios: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `horarios` DISABLE KEYS */;
INSERT INTO `horarios` (`idHorario`, `idTour`, `horario`) VALUES
	(1, 11, '2020-05-30 10:00:00'),
	(3, 11, '2020-06-10 18:30:00'),
	(4, 11, '2020-06-01 13:15:00'),
	(6, 12, '2020-06-30 17:15:00'),
	(7, 12, '2020-07-10 19:45:00'),
	(8, 13, '2020-06-09 08:00:00'),
	(9, 13, '2020-06-10 09:15:00'),
	(10, 13, '2020-06-20 08:30:00');
/*!40000 ALTER TABLE `horarios` ENABLE KEYS */;

-- Volcando estructura para tabla proyecto_final.reservapersonalizada
CREATE TABLE IF NOT EXISTS `reservapersonalizada` (
  `idReservaPersonalizada` int(11) NOT NULL AUTO_INCREMENT,
  `idCliente` int(11) NOT NULL,
  `idTour` int(11) NOT NULL,
  `idGuia` int(11) NOT NULL,
  `horario` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `idioma` varchar(50) NOT NULL DEFAULT '',
  `estado` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idReservaPersonalizada`),
  KEY `idCliente_reservaPersonalizada` (`idCliente`),
  KEY `idTour_reservaPersonalizada` (`idTour`),
  KEY `idGuia_reservaPersonalizada` (`idGuia`),
  CONSTRAINT `idCliente_reservaPersonalizada` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idCliente`),
  CONSTRAINT `idGuia_reservaPersonalizada` FOREIGN KEY (`idGuia`) REFERENCES `guias` (`idGuia`),
  CONSTRAINT `idTour_reservaPersonalizada` FOREIGN KEY (`idTour`) REFERENCES `tour` (`idTour`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyecto_final.reservapersonalizada: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `reservapersonalizada` DISABLE KEYS */;
INSERT INTO `reservapersonalizada` (`idReservaPersonalizada`, `idCliente`, `idTour`, `idGuia`, `horario`, `idioma`, `estado`) VALUES
	(2, 1, 12, 3, '2020-06-07 16:45:00', 'aleman', 'espera'),
	(3, 1, 12, 10, '2020-06-10 13:50:00', 'ingles', 'aceptado');
/*!40000 ALTER TABLE `reservapersonalizada` ENABLE KEYS */;

-- Volcando estructura para tabla proyecto_final.reservas
CREATE TABLE IF NOT EXISTS `reservas` (
  `idReserva` int(11) NOT NULL AUTO_INCREMENT,
  `idCliente` int(11) DEFAULT NULL,
  `idTour` int(11) DEFAULT NULL,
  `idGuia` int(11) DEFAULT NULL,
  `idHorario` int(11) DEFAULT NULL,
  PRIMARY KEY (`idReserva`),
  KEY `idCliente_reserva` (`idCliente`),
  KEY `idTour_reserva` (`idTour`),
  KEY `idGuia_reserva` (`idGuia`),
  KEY `idHorario_reserva` (`idHorario`),
  CONSTRAINT `idCliente_reserva` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idCliente`),
  CONSTRAINT `idGuia_reserva` FOREIGN KEY (`idGuia`) REFERENCES `guias` (`idGuia`),
  CONSTRAINT `idHorario_reserva` FOREIGN KEY (`idHorario`) REFERENCES `horarios` (`idHorario`),
  CONSTRAINT `idTour_reserva` FOREIGN KEY (`idTour`) REFERENCES `tour` (`idTour`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyecto_final.reservas: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `reservas` DISABLE KEYS */;
INSERT INTO `reservas` (`idReserva`, `idCliente`, `idTour`, `idGuia`, `idHorario`) VALUES
	(2, 1, 11, 2, 3),
	(3, 1, 11, 10, 1);
/*!40000 ALTER TABLE `reservas` ENABLE KEYS */;

-- Volcando estructura para tabla proyecto_final.tour
CREATE TABLE IF NOT EXISTS `tour` (
  `idTour` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `precio` double NOT NULL,
  PRIMARY KEY (`idTour`),
  UNIQUE KEY `titulo` (`titulo`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyecto_final.tour: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `tour` DISABLE KEYS */;
INSERT INTO `tour` (`idTour`, `titulo`, `descripcion`, `precio`) VALUES
	(11, 'Costa alicante', 'Tour por las playas de la costa mediterranea donde podra disfrutar del sol y el mar. Tambien podra disfrutar de un viaje a la isla de Tabarca y una sesion de buceo en su costa donde podra ver todo tipo de fauna acuatica.  ', 150),
	(12, 'Visita altea', 'Visita a la ciudad de Altea, tour por las playas mas importantes, el casco antiguo de la ciudad y parque natural de la Serra Gelada. Podra disfrutar de vistas maravillosas, buena gastronomia y playas espectaculares.', 50),
	(13, 'Ciudad de las artes y las ciencias', 'Tour guiado por la ciudad de las artes y las ciencias en Valencia. Visita por los seis edificios: hemisferic, museo de las ciencias, oceanografic, palacio de las artes, unbracle y agora.', 200),
	(16, 'prueba', 'prueba', 0);
/*!40000 ALTER TABLE `tour` ENABLE KEYS */;

-- Volcando estructura para tabla proyecto_final.tourguia
CREATE TABLE IF NOT EXISTS `tourguia` (
  `idTour` int(11) DEFAULT NULL,
  `idGuia` int(11) DEFAULT NULL,
  KEY `idTour_tourGuia` (`idTour`),
  KEY `idGuia_tourGuia` (`idGuia`),
  CONSTRAINT `idGuia_tourGuia` FOREIGN KEY (`idGuia`) REFERENCES `guias` (`idGuia`),
  CONSTRAINT `idTour_tourGuia` FOREIGN KEY (`idTour`) REFERENCES `tour` (`idTour`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyecto_final.tourguia: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `tourguia` DISABLE KEYS */;
INSERT INTO `tourguia` (`idTour`, `idGuia`) VALUES
	(11, 10),
	(12, 1),
	(13, 16),
	(11, 2),
	(12, 3);
/*!40000 ALTER TABLE `tourguia` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
