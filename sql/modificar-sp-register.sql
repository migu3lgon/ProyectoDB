DROP PROCEDURE IF EXISTS gioscorp2.registro;

CREATE DEFINER = `root` @`localhost`
PROCEDURE gioscorp2.registro(
   IN      correo   VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci,
   IN      clave    VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci,
   IN      name     VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci,
   IN      last_l   VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci,
   IN      tel      INT(14),
       OUT res      TINYINT(1))
   LANGUAGE SQL
   NOT DETERMINISTIC
   CONTAINS SQL
   SQL SECURITY DEFINER
BEGIN
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
                NULL);

   SELECT TRUE
     INTO res;
END;