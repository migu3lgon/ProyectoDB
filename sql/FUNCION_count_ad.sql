DROP FUNCTION IF EXISTS gioscorp2.count_ad;

CREATE DEFINER = `root` @`localhost`
FUNCTION gioscorp2.count_ad(id_usuario INT(11))
   RETURNS INT(11)
   LANGUAGE SQL
   DETERMINISTIC
   CONTAINS SQL
   SQL SECURITY DEFINER
BEGIN
   DECLARE id_user   INT;

   SET id_user = id_usuario;

   RETURN (SELECT count(titulo)
             FROM anuncio
            WHERE idusuario = id_user);
END;