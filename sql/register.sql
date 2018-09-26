DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `registro`(in correo varchar(100), in clave varchar(255))
BEGIN

INSERT INTO
 `usuario` (`idusuario`, `correo`, `password`, `nombre`, `apellido`, `telefono`, `saldo`) 
 VALUES (NULL, correo, clave, NULL, NULL, NULL, NULL);
END$$
DELIMITER ;
