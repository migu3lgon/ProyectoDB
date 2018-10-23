-- ----------------------------------------------------------------
--  PROCEDURE datos_perfil
-- ----------------------------------------------------------------

DROP PROCEDURE IF EXISTS gioscorp2.datos_perfil;

CREATE DEFINER = `root` @`localhost`
PROCEDURE gioscorp2.datos_perfil(IN id_v INT(11))
   LANGUAGE SQL
   NOT DETERMINISTIC
   CONTAINS SQL
   SQL SECURITY DEFINER
BEGIN
   SELECT correo,
          nombre,
          apellido,
          telefono
     FROM usuario
    WHERE idusuario = id_v;
END;


