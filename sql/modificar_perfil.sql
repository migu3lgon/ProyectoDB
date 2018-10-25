-- ----------------------------------------------------------------
--  PROCEDURE modificar_perfil
-- ----------------------------------------------------------------

DROP PROCEDURE IF EXISTS gioscorp2.modificar_perfil;

CREATE DEFINER = `root` @`localhost`
PROCEDURE gioscorp2.modificar_perfil(
   IN idusuario_v   INT(11),
   IN correo_v      VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci,
   IN nombre_v      VARCHAR(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci,
   IN apellido_v    VARCHAR(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci,
   IN telefono_v    INT(11))
   LANGUAGE SQL
   NOT DETERMINISTIC
   CONTAINS SQL
   SQL SECURITY DEFINER
BEGIN
   UPDATE usuario
      SET correo = correo_v,
          nombre = nombre_v,
          apellido = apellido_v,
          telefono = telefono_v
    WHERE idusuario = idusuario_v;
END;


