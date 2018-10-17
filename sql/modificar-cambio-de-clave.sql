DROP PROCEDURE IF EXISTS gioscorp2.cambio_clave;

CREATE DEFINER = `root` @`localhost`
PROCEDURE gioscorp2.cambio_clave(
   IN      correo_v       VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci,
   IN      clave_v        VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci,
   IN      clavenueva_v   VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci,
       OUT res            TINYINT(1))
   LANGUAGE SQL
   NOT DETERMINISTIC
   CONTAINS SQL
   SQL SECURITY DEFINER
BEGIN
   DECLARE pass   VARCHAR(255);
   DECLARE corr   VARCHAR(100);

   SELECT correo, psw
     INTO corr, pass
     FROM usuario
    WHERE correo = correo_v;

   IF pass = clave_v
   THEN
      UPDATE usuario
         SET psw = clavenueva_v
       WHERE usuario.correo = correo_v;

      SELECT TRUE
        INTO res;
   ELSE
      SELECT FALSE
        INTO res;
   END IF;
END;