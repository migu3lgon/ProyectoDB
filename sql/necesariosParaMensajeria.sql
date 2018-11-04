DROP TABLE IF EXISTS conversation;
ALTER TABLE mensajes
MODIFY COLUMN fecha DATETIME default NULL;

ALTER TABLE mensajes 
ADD COLUMN idconversacion INT GENERATED ALWAYS AS (CONCAT(idcomprador,idvendedor,idanuncio)) NOT NULL;



DROP PROCEDURE IF EXISTS getUserInfo;
DELIMITER //
CREATE PROCEDURE getUserInfo(IN idanun INT(11))
BEGIN
	SET @idad =  idanun;
	SELECT idusuario FROM anuncio WHERE idanuncio = @idad;
END; //
DELIMITER;


DROP PROCEDURE IF EXISTS newMsg;
DELIMITER //
CREATE PROCEDURE newMsg(IN idad INT(11) ,IN userone INT(11), IN usertwo INT(11), IN msg MEDIUMTEXT)

 BEGIN
 	
	 SET @adid = idad;
	 SET @us1 = userone;
	 SET @us2 = usertwo;
	 
	 SET @message = msg;
	 
	 
	 SET @date = NOW();
	 SET @dir = 1;
	 
	
		INSERT INTO mensajes (idanuncio, idcomprador, idvendedor, mensaje, fecha, direccion)
VALUES (@adid, @us1, @us2, @message, @date, @dir); 
 

 END; //
DELIMITER ;


DROP PROCEDURE IF EXISTS getConvBuy;
DELIMITER//
CREATE PROCEDURE getConvBuy(IN iduser INT(11))
BEGIN
	SELECT DISTINCT a.idanuncio, b.titulo, c.nombre, idvendedor, idconversacion FROM mensajes a INNER JOIN anuncio b ON a.idanuncio=b.idanuncio INNER JOIN usuario c ON a.idvendedor=c.idusuario
	WHERE (idcomprador=iduser) ORDER BY idanuncio asc;
	
END; //
DELIMITER;


DROP PROCEDURE IF EXISTS getConvSell;
DELIMITER//
CREATE PROCEDURE getConvSell(IN iduser INT(11))
BEGIN
	SELECT DISTINCT a.idanuncio, b.titulo, c.nombre, idcomprador, idconversacion FROM mensajes a INNER JOIN anuncio b ON a.idanuncio=b.idanuncio INNER JOIN usuario c ON a.idcomprador=c.idusuario
	WHERE (idvendedor=iduser) ORDER BY idanuncio asc;
	
END; //
DELIMITER;

DROP PROCEDURE IF EXISTS messageThreadReceived;
DELIMITER//
CREATE PROCEDURE messageThreadReceived(IN idconvo INT)
BEGIN
	SET @laConvo = idconvo;
	SELECT idmensajes, mensaje, a.fecha, b.nombre AS sender, b.apellido AS asender,d.nombre as receiver, d.apellido AS areceiver, c.titulo AS title, a.idanuncio, idvendedor, idcomprador, idconversacion FROM mensajes a 
	INNER JOIN usuario b ON b.idusuario=a.idcomprador INNER JOIN anuncio c ON a.idanuncio=c.idanuncio INNER JOIN usuario d ON d.idusuario=a.idvendedor
	WHERE idconversacion = @laConvo
	ORDER BY fecha asc;
	
END; //
DELIMITER;

DROP PROCEDURE IF EXISTS messageThreadSent;
DELIMITER//
CREATE PROCEDURE messageThreadSent(IN idconvo INT)
BEGIN
	SET @laConvo = idconvo;
	SELECT idmensajes, mensaje, a.fecha, b.nombre AS sender, b.apellido AS asender,d.nombre as receiver, d.apellido AS areceiver, c.titulo AS title, 
	a.idanuncio AS anuncad, idvendedor, idcomprador, idconversacion, direccion FROM mensajes a 
	INNER JOIN usuario b ON b.idusuario=a.idvendedor INNER JOIN anuncio c ON a.idanuncio=c.idanuncio INNER JOIN usuario d ON d.idusuario=a.idcomprador
	WHERE idconversacion = @laConvo
	ORDER BY fecha asc;
	
END; //
DELIMITER;

DROP PROCEDURE IF EXISTS answMsg;
DELIMITER //
CREATE PROCEDURE answMsg(IN idad INT(11) ,IN userone INT(11), IN usertwo INT(11), IN msg MEDIUMTEXT)

 BEGIN
 	
	 SET @adid = idad;
	 SET @us1 = userone;
	 SET @us2 = usertwo;
	 
	 SET @message = msg;
	 SET @convoid = CONCAT(usertwo,userone,idad);
	 
		 
	 SET @date = NOW();
	 SET @dir = 1;
	 SET @dirno = 0;
	 
	
		INSERT INTO mensajes (idanuncio, idcomprador, idvendedor, mensaje, fecha)
	VALUES (@adid, @us2, @us1, @message, @date); 
	

 END; //
DELIMITER ;
