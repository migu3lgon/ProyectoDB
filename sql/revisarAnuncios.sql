-- ----------------------------------------------------------------
--  FUNCTION revisaranuncios
-- ----------------------------------------------------------------

DROP FUNCTION IF EXISTS gioscorp2.revisaranuncios;

CREATE DEFINER = `root` @`localhost`
FUNCTION gioscorp2.revisaranuncios(usr INT(11))
   RETURNS INT(11)
   LANGUAGE SQL
   SQL SECURITY DEFINER
BEGIN
   DECLARE anuncioid   INT;
   SET anuncioid =
          (  SELECT idanuncio
               FROM anuncio
              WHERE idusuario = usr
           ORDER BY idanuncio ASC
              LIMIT 1);

   IF anuncioid IS NULL
   THEN
      SET anuncioid = 0;
   END IF;

   RETURN anuncioid;
END;


