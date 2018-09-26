DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `registro`(in correo varchar(100), in clave varchar(255))
BEGIN

DECLARE EXIT HANDLER FOR SQLEXCEPTION
SELECT 'SQLException invoked';
 
DECLARE EXIT HANDLER FOR 1062
        SELECT 'El correo ingresado ya esta en uso';

INSERT INTO `usuario` (`idusuario`, `correo`, `psw`, `nombre`, `apellido`, `telefono`, `saldo`) 
 VALUES (NULL, correo, clave, NULL, NULL, NULL, NULL);
END$$
DELIMITER ;
