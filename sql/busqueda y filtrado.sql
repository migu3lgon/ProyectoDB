DROP PROCEDURE IF EXISTS getData;

DELIMITER //
CREATE PROCEDURE getData(IN elValue VARCHAR(255))

 BEGIN
 SET @lValue = elValue;
 SET @lValue2 = @lValue;/*CAST(@lValue AS UNSIGNED);*/
 SET @lValue3 = @lValue;
 SET @lValue4 = @lValue;
 
 SELECT titulo, datostecnicos, descripcion, fecha, masinformacion, precio, Imagen FROM anuncio WHERE titulo LIKE CONCAT('%', @lValue, '%') 
 OR precio LIKE CONCAT('%', @lValue2, '%') OR (descripcion LIKE CONCAT('%', @lValue3, '%')) OR (masinformacion LIKE CONCAT('%', @lValue4, '%'));
 
 
 /*or precio LIKE CONCAT('%', @lValue, '%');
 CAST(PROD_CODE AS UNSIGNED)
 DECIMAL[(M[,D])]*/
 END; //
DELIMITER ;