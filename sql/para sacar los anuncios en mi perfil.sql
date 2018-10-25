-- ----------------------------------------------------------------
--  PROCEDURE informacion_mis_anuncios
-- ----------------------------------------------------------------

DROP PROCEDURE IF EXISTS gioscorp2.informacion_mis_anuncios;

CREATE DEFINER = `root` @`localhost`
PROCEDURE gioscorp2.informacion_mis_anuncios(IN id_v INT(11))
   LANGUAGE SQL
   NOT DETERMINISTIC
   CONTAINS SQL
   SQL SECURITY DEFINER
BEGIN
   SELECT *
     FROM anuncio
    WHERE idusuario = id_v;
END;


