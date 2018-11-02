DROP PROCEDURE IF EXISTS acreditar;
CREATE PROCEDURE acreditar(IN user INT, monto INT, OUT res bool)
BEGIN
	DECLARE usuario_p int;
	DECLARE monto_p int;
	DECLARE saldo_p int;
	DECLARE EXIT HANDLER FOR SQLEXCEPTION 
	BEGIN 
		ROLLBACK;
		SELECT 'Ha ocurrido un error con el insert';
		SET res = false;
	END;
	SET usuario_p = user;
	SELECT saldo FROM usuario where idusuario = usuario_p INTO saldo_p;
	SET monto_p = monto + saldo_p;
	
	/*Aqui estaria la logica de la tarjeta de credito*/
	
	UPDATE usuario SET saldo = monto_p WHERE idusuario = usuario_p;
	SET res = true;
	Commit;
	
END;