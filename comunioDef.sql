-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.21-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE TABLE IF NOT EXISTS `users` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(12) DEFAULT NULL,
  `pass` varchar(30) DEFAULT NULL,
  `tipo` varchar(12) DEFAULT NULL,
  `hab` int(11) DEFAULT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
-- Volcando estructura para tabla comunio.comunios
CREATE TABLE IF NOT EXISTS `comunios` (
  `idComunio` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `idUser` int(11) DEFAULT NULL,
  `numberMarket` smallint(6) DEFAULT NULL,
  `pass` varchar(12) DEFAULT NULL,
  `name` varchar(12) NOT NULL,
  PRIMARY KEY (`idComunio`),
  KEY `idUser` (`idUser`),
  CONSTRAINT `comunios_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla comunio.equipocom
CREATE TABLE IF NOT EXISTS `equipocom` (
  `idEC` smallint(6) NOT NULL AUTO_INCREMENT,
  `idComunio` smallint(5) unsigned,
  `idUser` int(11) DEFAULT NULL,
  `nombre` varchar(12) DEFAULT NULL,
  `puntos` smallint(5) unsigned DEFAULT NULL,
  `dinero` mediumint(9) DEFAULT NULL,
  PRIMARY KEY (`idEC`),
  KEY `idUser` (`idUser`),
  KEY `FK_equipocom_comunios` (`idComunio`),
  CONSTRAINT `FK_equipocom_comunios` FOREIGN KEY (`idComunio`) REFERENCES `comunios` (`idComunio`),
  CONSTRAINT `equipocom_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla comunio.equipos
CREATE TABLE IF NOT EXISTS `equipos` (
  `nombre` varchar(12) NOT NULL,
  PRIMARY KEY (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla comunio.jugadores
CREATE TABLE IF NOT EXISTS `jugadores` (
  `idJugador` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `puntos` smallint(5) unsigned DEFAULT NULL,
  `nombre` varchar(14) DEFAULT NULL,
  `posicion` varchar(5) DEFAULT NULL,
  `equipo` varchar(12) DEFAULT NULL,
  `valor` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`idJugador`),
  KEY `FK_jugadores_equipos` (`equipo`),
  CONSTRAINT `FK_jugadores_equipos` FOREIGN KEY (`equipo`) REFERENCES `equipos` (`nombre`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla comunio.jugcom
CREATE TABLE IF NOT EXISTS `jugcom` (
  `idJugador` smallint(5) unsigned DEFAULT NULL,
  `idEquipo` smallint(6) DEFAULT NULL,
  `idJC` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `mercado` bit(1) DEFAULT NULL,
  `numberMercado` smallint(5) unsigned DEFAULT NULL,
  `idComunio` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`idJC`),
  KEY `idEquipo` (`idEquipo`),
  KEY `FK_jugcom_comunios` (`idComunio`),
  KEY `jugcom_ibfk_1` (`idJugador`),
  CONSTRAINT `FK_jugcom_comunios` FOREIGN KEY (`idComunio`) REFERENCES `comunios` (`idComunio`),
  CONSTRAINT `jugcom_ibfk_1` FOREIGN KEY (`idJugador`) REFERENCES `jugadores` (`idJugador`) ON DELETE CASCADE,
  CONSTRAINT `jugcom_ibfk_2` FOREIGN KEY (`idEquipo`) REFERENCES `equipocom` (`idEC`)
) ENGINE=InnoDB AUTO_INCREMENT=185 DEFAULT CHARSET=latin1;
-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla comunio.ofertas
CREATE TABLE IF NOT EXISTS `ofertas` (
  `idJugCom` smallint(5) unsigned DEFAULT NULL,
  `oferta` smallint(5) unsigned DEFAULT NULL,
  `ofertante` smallint(6) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idOferta` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `aceptada` bit(1) DEFAULT b'0',
  PRIMARY KEY (`idOferta`),
  KEY `idJugCom` (`idJugCom`),
  KEY `ofertante` (`ofertante`),
  CONSTRAINT `ofertas_ibfk_1` FOREIGN KEY (`idJugCom`) REFERENCES `jugcom` (`idJC`),
  CONSTRAINT `ofertas_ibfk_2` FOREIGN KEY (`ofertante`) REFERENCES `equipocom` (`idEC`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla comunio.fichajes
CREATE TABLE IF NOT EXISTS `fichajes` (
  `idFichaje` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `idOferta` smallint(5) unsigned DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `equipo1` smallint(5) DEFAULT NULL,
  `equipo2` smallint(5) DEFAULT NULL,
  `precio` smallint(5) unsigned DEFAULT NULL,
  `idjugcom` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`idFichaje`),
  KEY `FK_fichajes_equipocom` (`equipo1`),
  KEY `FK_fichajes_equipocom_2` (`equipo2`),
  KEY `fichajes_ibfk_1` (`idOferta`),
  CONSTRAINT `FK_fichajes_equipocom` FOREIGN KEY (`equipo1`) REFERENCES `equipocom` (`idEC`),
  CONSTRAINT `FK_fichajes_equipocom_2` FOREIGN KEY (`equipo2`) REFERENCES `equipocom` (`idEC`),
  CONSTRAINT `fichajes_ibfk_1` FOREIGN KEY (`idOferta`) REFERENCES `ofertas` (`idOferta`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;



-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla comunio.partidos
CREATE TABLE IF NOT EXISTS `partidos` (
  `idPartido` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `equipo1` varchar(12) DEFAULT NULL,
  `equipo2` varchar(12) DEFAULT NULL,
  `resultado` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`idPartido`),
  KEY `equipo1` (`equipo1`),
  KEY `equipo2` (`equipo2`),
  CONSTRAINT `partidos_ibfk_1` FOREIGN KEY (`equipo1`) REFERENCES `equipos` (`nombre`),
  CONSTRAINT `partidos_ibfk_2` FOREIGN KEY (`equipo2`) REFERENCES `equipos` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla comunio.statsjugadores
CREATE TABLE IF NOT EXISTS `statsjugadores` (
  `idStat` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idJugador` smallint(5) unsigned DEFAULT NULL,
  `idPartido` smallint(5) unsigned DEFAULT NULL,
  `goles` smallint(5) unsigned DEFAULT NULL,
  `asist` smallint(5) unsigned DEFAULT NULL,
  `puntos` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`idStat`),
  KEY `idPartido` (`idPartido`),
  KEY `statsjugadores_ibfk_1` (`idJugador`),
  CONSTRAINT `statsjugadores_ibfk_1` FOREIGN KEY (`idJugador`) REFERENCES `jugadores` (`idJugador`) ON DELETE CASCADE,
  CONSTRAINT `statsjugadores_ibfk_2` FOREIGN KEY (`idPartido`) REFERENCES `partidos` (`idPartido`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla comunio.users


-- La exportación de datos fue deseleccionada.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
