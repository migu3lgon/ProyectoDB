DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `cambio_clave`(in correo_v varchar(100), in clave_v varchar(255), in clavenueva_v varchar(255))
BEGIN
	declare pass varchar(255);
declare corr varchar(100);
	select correo, psw into corr, pass from usuario where correo = correo_v;
    
	if pass = clave_v then
		UPDATE usuario SET psw = clavenueva_v WHERE usuario.correo = correo_v;
	else
		select 'wrong user or password';
    end if;
END$$
DELIMITER ;
