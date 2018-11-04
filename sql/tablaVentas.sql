-- ----------------------------------------------------------------
--  TABLE ventas
-- ----------------------------------------------------------------

CREATE TABLE gioscorp2.ventas
(
   idventa      INT(11) NOT NULL AUTO_INCREMENT,
   idusuario    INT(11) NOT NULL,
   idanuncio    INT(11) NOT NULL,
   monto        INT(11) NOT NULL,
   fecha        DATETIME(0) NOT NULL,
   PRIMARY KEY(idventa)
)
ENGINE INNODB
COLLATE 'latin1_swedish_ci'
ROW_FORMAT DEFAULT;


