-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 30-10-2018 a las 02:23:40
-- Versión del servidor: 5.7.21
-- Versión de PHP: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gioscorp2`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `anuncio_nuevo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `anuncio_nuevo` (IN `titulo_v` VARCHAR(45), IN `descripcion_v` MEDIUMTEXT, IN `subcategoria_v` INT, IN `ubicacion_v` INT, IN `imagen_v` MEDIUMBLOB, IN `telefono_v` INT, IN `fecha_v` DATE)  BEGIN
	INSERT INTO `anuncio` (`titulo`, `descripcion`, `idsubcategoria`, `idubicacion`, `imagen`, `telefono`, `fecha`) 
		VALUES (titulo_v, descripcion_v, subcategoria_v, ubicacion_v, imagen_v, telefono_v, fecha_v);
END$$

DROP PROCEDURE IF EXISTS `cambio_clave`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `cambio_clave` (IN `correo_v` VARCHAR(100), IN `clave_v` VARCHAR(255), IN `clavenueva_v` VARCHAR(255), OUT `res` BOOLEAN)  BEGIN
	declare pass varchar(255);
declare corr varchar(100);
	select correo, psw into corr, pass from usuario where correo = correo_v;
    
	if pass = clave_v then
		UPDATE usuario SET psw = clavenueva_v WHERE usuario.correo = correo_v;
        SELECT true into res;
	else
		SELECT false into res;
    end if;
END$$

DROP PROCEDURE IF EXISTS `datos_perfil`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `datos_perfil` (IN `id_v` INT(11))  BEGIN
   SELECT *
     FROM usuario
    WHERE idusuario = id_v;
END$$

DROP PROCEDURE IF EXISTS `desdestacar`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `desdestacar` ()  BEGIN
   DECLARE now      DATE;
   DECLARE done     INT DEFAULT 0;
   DECLARE vence    DATE;
   DECLARE iddest   INT;

   DECLARE
      cur1 CURSOR FOR SELECT fechafin, iddestacado FROM gioscorp2.destacado;

   DECLARE CONTINUE HANDLER FOR NOT FOUND
   SET done = 1;
   SET now = (SELECT CURDATE());

   OPEN cur1;

  read_loop:
   LOOP
      FETCH cur1 INTO vence, iddest;

      IF done = 1
      THEN
         BEGIN
            LEAVE read_loop;
         END;
      END IF;

      IF now >= vence
      THEN
         UPDATE gioscorp2.destacado
            SET destacado = 0
          WHERE iddestacado = iddest;
      END IF;
   END LOOP;
END$$

DROP PROCEDURE IF EXISTS `destacar`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `destacar` (IN `idanuncio_v` INT(11), IN `fecha1` DATE, IN `fecha2` DATE, IN `usuario` INT(11), OUT `res` TINYINT(1))  Proc_label:
BEGIN
   DECLARE dias      INT;
   DECLARE precio    INT DEFAULT 10;
   DECLARE total     INT;
   DECLARE saldo_u   INT
                        DEFAULT (SELECT saldo
                                   FROM usuario
                                  WHERE idusuario = usuario);
   SET dias = (SELECT dias(fecha2, fecha1));
   SET total = dias * precio;

   INSERT INTO destacado(idanuncio,
                         destacado,
                         fechainicio,
                         fechafin)
        VALUES (idanuncio_v,
                1,
                fecha1,
                fecha2);

   SET saldo_u = saldo_u - total;

   IF (saldo_u < 0)
   THEN
      SELECT TRUE
        INTO res;

      LEAVE proc_label;
   END IF;

   UPDATE usuario
      SET saldo = saldo_u
    WHERE idusuario = usuario;

   SELECT FALSE
     INTO res;
END$$

DROP PROCEDURE IF EXISTS `getData`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getData` (IN `elValue` VARCHAR(255), IN `elOtroValue` VARCHAR(255), IN `locValue` VARCHAR(255), IN `precValue` VARCHAR(255))  BEGIN
 SET @lValue = elValue;
 SET @lValue2 = @lValue;
 SET @lValue3 = @lValue;
 SET @lValue4 = @lValue;
 SET @lValue5 = @lValue;
 SET @lValue6 = @lValue;
 SET @lValue7 = @lValue;
 SET @lValue8 = @lValue;
 SET @lValue9 = @lValue;
 
 SET @lValor = elOtroValue; 
 
 SET @locVal = locValue;
 
 SET @precValor = precValue;
 


 SELECT idanuncio,destacado, titulo, datostecnicos, descripcion, fecha, masinformacion, precio, d.ubicacion, Imagen, c.categoria, b.subcategoria 
FROM anuncio a INNER JOIN subcategorias b on a.idsubcategoria=b.idsubcategoria INNER JOIN categorias c on b.idcategoria=c.idcategoria 
INNER JOIN ubicaciones d on a.idubicacion=d.idubicacion WHERE (titulo LIKE CONCAT('%', @lValue, '%') 
 OR precio LIKE CONCAT('%', @lValue2, '%') OR descripcion LIKE CONCAT('%', @lValue3, '%') OR masinformacion LIKE CONCAT('%', @lValue4, '%')
 OR d.ubicacion LIKE CONCAT('%', @lValue7, '%'))
 AND (b.subcategoria LIKE CONCAT('%', @lValor, '%')) AND (d.ubicacion LIKE CONCAT('%', @locVal, '%')) AND (precio LIKE CONCAT('%', @precValor, '%'));
 

 END$$

DROP PROCEDURE IF EXISTS `informacion_mis_anuncios`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `informacion_mis_anuncios` (IN `id_v` INT(11))  BEGIN
   SELECT *
     FROM anuncio
    WHERE idusuario = id_v;
END$$

DROP PROCEDURE IF EXISTS `login`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `login` (IN `correo_v` VARCHAR(100), IN `clave_v` VARCHAR(255), OUT `res` BOOLEAN)  BEGIN
declare pass varchar(255);
declare corr varchar(100);
	select correo, psw into corr, pass from usuario where correo = correo_v;
    
	if pass = clave_v then
		select true into res;
	else
		select false into res;
    end if;
END$$

DROP PROCEDURE IF EXISTS `modificar_perfil`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_perfil` (IN `idusuario_v` INT(11), IN `correo_v` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci, IN `nombre_v` VARCHAR(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci, IN `apellido_v` VARCHAR(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci, IN `telefono_v` INT(11))  BEGIN
   UPDATE usuario
      SET correo = correo_v,
          nombre = nombre_v,
          apellido = apellido_v,
          telefono = telefono_v
    WHERE idusuario = idusuario_v;
END$$

DROP PROCEDURE IF EXISTS `obtener_anuncio`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `obtener_anuncio` (IN `id` INT)  BEGIN
	select * from anuncio where idanuncio = id;
END$$

DROP PROCEDURE IF EXISTS `registro`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `registro` (IN `correo` VARCHAR(100), IN `clave` VARCHAR(255), IN `name` VARCHAR(255), IN `last_l` VARCHAR(255), IN `tel` INT(14), OUT `res` TINYINT(1))  BEGIN
   DECLARE EXIT HANDLER FOR SQLEXCEPTION
   SELECT 'SQLException invoked';

   DECLARE EXIT HANDLER FOR 1062
   SELECT FALSE
     INTO res;

   INSERT INTO `usuario`(`idusuario`,
                         `correo`,
                         `psw`,
                         `nombre`,
                         `apellido`,
                         `telefono`,
                         `saldo`)
        VALUES (NULL,
                correo,
                clave,
                name,
                last_l,
                tel,
                0);

   SELECT TRUE
     INTO res;
END$$

--
-- Funciones
--
DROP FUNCTION IF EXISTS `dias`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `dias` (`fecha1` DATE, `fecha2` DATE) RETURNS INT(11) BEGIN
   DECLARE dias   INT;

   SELECT DATEDIFF(fecha1, fecha2) AS days
     INTO dias;

   RETURN dias;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncio`
--

DROP TABLE IF EXISTS `anuncio`;
CREATE TABLE IF NOT EXISTS `anuncio` (
  `idanuncio` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) DEFAULT NULL,
  `descripcion` mediumtext,
  `idsubcategoria` int(11) DEFAULT NULL,
  `idubicacion` int(11) DEFAULT NULL,
  `Imagen` mediumblob,
  `vendido` bit(1) DEFAULT b'0',
  `telefono` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `datostecnicos` text CHARACTER SET latin1 COLLATE latin1_spanish_ci,
  `masinformacion` text,
  `precio` decimal(13,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`idanuncio`),
  KEY `fksubcategoria_idx` (`idsubcategoria`),
  KEY `fkubicacion_idx` (`idubicacion`),
  KEY `idusuario_idx` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `anuncio`
--

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `anunciodestacado`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `anunciodestacado`;
CREATE TABLE IF NOT EXISTS `anunciodestacado` (
`idanuncio` int(11)
,`precio` decimal(13,2)
,`vendido` bit(1)
,`descripcion` mediumtext
,`masinformacion` text
,`idubicacion` int(11)
,`titulo` varchar(45)
,`fecha` date
,`idusuario` int(11)
,`idsubcategoria` int(11)
,`Imagen` mediumblob
,`datostecnicos` text
,`telefono` int(11)
,`destacado` bit(1)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `idcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idcategoria`, `categoria`) VALUES
(1, 'categoria1'),
(2, 'categoria2');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `compradestacado`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `compradestacado`;
CREATE TABLE IF NOT EXISTS `compradestacado` (
`iddestacado` int(11)
,`saldo` decimal(13,2)
,`fechafin` date
,`fechainicio` date
,`idanuncio` int(11)
,`destacado` bit(1)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destacado`
--

DROP TABLE IF EXISTS `destacado`;
CREATE TABLE IF NOT EXISTS `destacado` (
  `iddestacado` int(11) NOT NULL AUTO_INCREMENT,
  `idanuncio` int(11) NOT NULL,
  `destacado` bit(1) DEFAULT b'0',
  `fechainicio` date NOT NULL,
  `fechafin` date NOT NULL,
  PRIMARY KEY (`iddestacado`),
  KEY `idanuncio_idx` (`idanuncio`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `destacado`
--

INSERT INTO `destacado` (`iddestacado`, `idanuncio`, `destacado`, `fechainicio`, `fechafin`) VALUES
(3, 86, b'1', '2018-10-22', '2018-10-26'),
(4, 87, b'1', '2018-10-25', '2018-10-29'),
(5, 88, b'1', '2018-10-25', '2018-10-26'),
(6, 93, NULL, '2018-10-25', '2018-05-16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

DROP TABLE IF EXISTS `mensajes`;
CREATE TABLE IF NOT EXISTS `mensajes` (
  `idmensajes` int(11) NOT NULL AUTO_INCREMENT,
  `idvendedor` int(11) DEFAULT NULL,
  `idcomprador` int(11) DEFAULT NULL,
  `idanuncio` int(11) DEFAULT NULL,
  `mensaje` mediumtext,
  `direccion` bit(1) DEFAULT NULL COMMENT 'direccion de a donde va el mensaje comprador->vendedor o vendedor->comprador',
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`idmensajes`),
  KEY `fkvendedor_idx` (`idvendedor`),
  KEY `fkcomprador_idx` (`idcomprador`),
  KEY `fkanuncio_idx` (`idanuncio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

DROP TABLE IF EXISTS `subcategorias`;
CREATE TABLE IF NOT EXISTS `subcategorias` (
  `idsubcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `idcategoria` int(11) DEFAULT NULL,
  `subcategoria` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idsubcategoria`),
  KEY `fkcategoria_idx` (`idcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `subcategorias`
--

INSERT INTO `subcategorias` (`idsubcategoria`, `idcategoria`, `subcategoria`) VALUES
(1, 1, 'subcategoria 1.1'),
(2, 1, 'subcategoria 1.2'),
(3, 2, 'subcat 2.1'),
(4, 2, 'subcat 2.2'),
(5, 2, 'subcat 2.3'),
(6, 2, 'subcat 2.4'),
(7, 2, 'subcat 2.5'),
(8, 2, 'Gio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicaciones`
--

DROP TABLE IF EXISTS `ubicaciones`;
CREATE TABLE IF NOT EXISTS `ubicaciones` (
  `idubicacion` int(11) NOT NULL AUTO_INCREMENT,
  `ubicacion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idubicacion`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ubicaciones`
--

INSERT INTO `ubicaciones` (`idubicacion`, `ubicacion`) VALUES
(1, 'z1'),
(2, 'z2'),
(3, 'z3'),
(4, 'z4'),
(5, 'z5'),
(6, 'z6'),
(7, 'z7'),
(8, 'z8'),
(9, 'z9'),
(10, 'z10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `correo` varchar(100) NOT NULL,
  `psw` varchar(255) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `saldo` decimal(13,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `correo_UNIQUE` (`correo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `correo`, `psw`, `nombre`, `apellido`, `telefono`, `saldo`) VALUES
(1, 'usuario1@usuarios.com', 'nueva', 'usuario1', 'apellido usuario1', 12345678, '0.00'),
(2, 'usuario2@usuarios.com', 'usuario2', 'usuario2', 'apellido usuario2', 87654321, '0.00'),
(3, 'correo@correo.com', 'password', NULL, NULL, NULL, '0.00'),
(4, 'correop@prueba.com', 'nombre procedure', NULL, NULL, NULL, '0.00'),
(6, 'correopruebaprocedure2', 'facil', NULL, NULL, NULL, '0.00'),
(7, 'test@m.com', 'test', 'Nombre test', NULL, NULL, '20.00'),
(8, 'mleiva2@unis2.com', 'cuatro', 'GioDOS', 'LeivaDOS', 202020202, '0.00');

-- --------------------------------------------------------

--
-- Estructura para la vista `anunciodestacado`
--
DROP TABLE IF EXISTS `anunciodestacado`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `anunciodestacado`  AS  select `anuncio`.`idanuncio` AS `idanuncio`,`anuncio`.`precio` AS `precio`,`anuncio`.`vendido` AS `vendido`,`anuncio`.`descripcion` AS `descripcion`,`anuncio`.`masinformacion` AS `masinformacion`,`anuncio`.`idubicacion` AS `idubicacion`,`anuncio`.`titulo` AS `titulo`,`anuncio`.`fecha` AS `fecha`,`anuncio`.`idusuario` AS `idusuario`,`anuncio`.`idsubcategoria` AS `idsubcategoria`,`anuncio`.`Imagen` AS `Imagen`,`anuncio`.`datostecnicos` AS `datostecnicos`,`anuncio`.`telefono` AS `telefono`,max(`destacado`.`destacado`) AS `destacado` from (`anuncio` left join `destacado` on((`anuncio`.`idanuncio` = `destacado`.`idanuncio`))) group by `anuncio`.`idanuncio` order by `destacado`.`destacado` desc ;

-- --------------------------------------------------------

--
-- Estructura para la vista `compradestacado`
--
DROP TABLE IF EXISTS `compradestacado`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `compradestacado`  AS  select `destacado`.`iddestacado` AS `iddestacado`,`usuario`.`saldo` AS `saldo`,`destacado`.`fechafin` AS `fechafin`,`destacado`.`fechainicio` AS `fechainicio`,`destacado`.`idanuncio` AS `idanuncio`,`destacado`.`destacado` AS `destacado` from ((`usuario` join `destacado`) join `anuncio` on(((`usuario`.`idusuario` = `anuncio`.`idusuario`) and (`anuncio`.`idanuncio` = `destacado`.`idanuncio`)))) ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anuncio`
--
ALTER TABLE `anuncio`
  ADD CONSTRAINT `fksubcategoria` FOREIGN KEY (`idsubcategoria`) REFERENCES `subcategorias` (`idsubcategoria`),
  ADD CONSTRAINT `fkubicacion` FOREIGN KEY (`idubicacion`) REFERENCES `ubicaciones` (`idubicacion`),
  ADD CONSTRAINT `fkusuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `fkanuncio` FOREIGN KEY (`idanuncio`) REFERENCES `anuncio` (`idanuncio`),
  ADD CONSTRAINT `fkcomprador` FOREIGN KEY (`idcomprador`) REFERENCES `usuario` (`idusuario`),
  ADD CONSTRAINT `fkvendedor` FOREIGN KEY (`idvendedor`) REFERENCES `usuario` (`idusuario`);

--
-- Filtros para la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD CONSTRAINT `fkcategoria` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`idcategoria`);

DELIMITER $$
--
-- Eventos
--
DROP EVENT `e_desdestacar`$$
CREATE DEFINER=`root`@`localhost` EVENT `e_desdestacar` ON SCHEDULE EVERY 1 DAY STARTS '2018-10-23 00:00:00' ON COMPLETION PRESERVE ENABLE DO call desdestacar()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
