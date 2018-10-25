-- ----------------------------------------------------------------
--  FUNCTION dias
-- ----------------------------------------------------------------

DROP FUNCTION IF EXISTS gioscorp2.dias;

CREATE DEFINER = `root` @`localhost`
FUNCTION gioscorp2.dias(fecha1 DATE, fecha2 DATE)
   RETURNS INT(11)
   LANGUAGE SQL
   SQL SECURITY DEFINER
BEGIN
   DECLARE dias   INT;

   SELECT DATEDIFF(fecha1, fecha2) AS days
     INTO dias;

   RETURN dias;
END;


