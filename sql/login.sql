-- ----------------------------------------------------------------
--  PROCEDURE login
-- ----------------------------------------------------------------

DROP PROCEDURE IF EXISTS gioscorp2.login;

CREATE DEFINER = `root` @`localhost`
PROCEDURE gioscorp2.login(
   IN      correo_v   VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci,
   IN      clave_v    VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci,
       OUT res        TINYINT(1))
   LANGUAGE SQL
   NOT DETERMINISTIC
   CONTAINS SQL
   SQL SECURITY DEFINER
BEGIN
   DECLARE pass   VARCHAR(255);
   DECLARE corr   VARCHAR(100);
   DECLARE usr    INT;

   SELECT correo, psw, idusuario
     INTO corr, pass, usr
     FROM usuario
    WHERE correo = correo_v;

   IF pass = clave_v
   THEN
      SELECT TRUE
        INTO res;

      UPDATE usuario
         SET lastlogin = (SELECT now())
       WHERE idusuario = usr;
   ELSE
      SELECT FALSE
        INTO res;
   END IF;
END;


