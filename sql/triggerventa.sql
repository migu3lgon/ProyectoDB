-- ----------------------------------------------------------------
--  TRIGGER vendido
-- ----------------------------------------------------------------

DROP TRIGGER IF EXISTS gioscorp2.vendido;

CREATE DEFINER = `root` @`localhost` TRIGGER gioscorp2.vendido
   AFTER INSERT
   ON gioscorp2.ventas
   FOR EACH ROW
BEGIN
   DECLARE anuncioid   INT;
   DECLARE vendidoid   INT;
   SET vendidoid = (SELECT LAST_INSERT_ID());
   SET anuncioid =
          (SELECT idanuncio
             FROM ventas
            WHERE idventa = vendidoid);

   UPDATE anuncio
      SET vendido = 1
    WHERE idanuncio = anuncioid;
END;


