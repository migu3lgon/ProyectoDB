-- ----------------------------------------------------------------
--  PROCEDURE desdestacar
-- ----------------------------------------------------------------

DROP PROCEDURE IF EXISTS gioscorp2.desdestacar;

CREATE DEFINER = `root` @`localhost`
PROCEDURE gioscorp2.desdestacar ()
   LANGUAGE SQL
   NOT DETERMINISTIC
   CONTAINS SQL
   SQL SECURITY DEFINER
BEGIN
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
END;


