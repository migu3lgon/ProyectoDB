-- ----------------------------------------------------------------
--  PROCEDURE clr_old
-- ----------------------------------------------------------------

DROP PROCEDURE IF EXISTS gioscorp2.clr_old;

CREATE DEFINER = `root` @`localhost`
PROCEDURE gioscorp2.clr_old ()
   LANGUAGE SQL
   NOT DETERMINISTIC
   CONTAINS SQL
   SQL SECURITY DEFINER
BEGIN
   DECLARE now           DATE;
   DECLARE fecha2        DATE;
   DECLARE done          INT DEFAULT 0;
   DECLARE usuario       INT;
   DECLARE anunciotemp   INT;

   DECLARE
      cur1 CURSOR FOR SELECT idusuario, lastlogin FROM gioscorp2.usuario;

   DECLARE CONTINUE HANDLER FOR NOT FOUND
   SET done = 1;
   SET anunciotemp = 1;
   SET now = (SELECT CURDATE());

   OPEN cur1;

  read_loop:
   LOOP
      FETCH cur1 INTO usuario, fecha2;

      IF done = 1
      THEN
         BEGIN
            LEAVE read_loop;
         END;
      END IF;

      IF now >= fecha2 + INTERVAL 1 YEAR
      THEN
         WHILE anunciotemp != 0
         DO
            SET anunciotemp = (SELECT revisaranuncios(usuario));

            DELETE FROM destacado
                  WHERE idanuncio = anunciotemp;

            DELETE FROM anuncio
                  WHERE idanuncio = anunciotemp;
         END WHILE;

         DELETE FROM usuario
               WHERE idusuario = usuario;
      /*insert into pivote (idusuario, fecha) values (usuario, fecha2);*/
      /*prueba_loop: LOOP
      IF anunciotemp = 0
      THEN
      begin
         LEAVE prueba_loop;
   end;
      END IF;
      set anunciotemp =(select revisaranuncios(usuario));
  DELETE FROM destacado where idanuncio = anunciotemp;
      END LOOP;*/
      /*while anunciotemp !=0
            do
       set anunciotemp = (select revisaranuncios(usuario));
       DELETE FROM destacado where idanuncio = anunciotemp;
      END WHILE;*/
      /*REPEAT
       set anunciotemp =(select revisaranuncios(usuario));
       DELETE FROM destacado where idanuncio = anunciotemp;
      UNTIL anunciotemp = 0
      END REPEAT;*/
      END IF;
   END LOOP;

   COMMIT;
END;


