-- ----------------------------------------------------------------
--  PROCEDURE destacar
-- ----------------------------------------------------------------

DROP PROCEDURE IF EXISTS gioscorp2.destacar;

CREATE DEFINER = `root` @`localhost`
PROCEDURE gioscorp2.destacar(IN      idanuncio_v   INT(11),
                             IN      fecha1        DATE,
                             IN      fecha2        DATE,
                             IN      usuario       INT(11),
                                 OUT res           TINYINT(1))
   LANGUAGE SQL
   NOT DETERMINISTIC
   CONTAINS SQL
   SQL SECURITY DEFINER
   Proc_label:
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
END;


