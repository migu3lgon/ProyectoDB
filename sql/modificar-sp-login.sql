DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `cambio_clave`(in correo_v varchar(100), in clave_v varchar(255), out res boolean)
BEGIN
declare pass varchar(255);
declare corr varchar(100);
	select correo, psw into corr, pass from usuario where correo = correo_v;
    
	if pass = clave_v then
		select true into res;
	else
		select false into res;
    end if;
END;