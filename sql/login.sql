DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `login`(in correo_v varchar(100), in clave_v varchar(255))
BEGIN
declare pass varchar(255);
declare corr varchar(100);
	select correo, psw into corr, pass from usuario where correo = correo_v;
    
	if pass = clave_v then
		select 'success';
	else
		select 'wrong user or password';
    end if;
END$$
DELIMITER ;
