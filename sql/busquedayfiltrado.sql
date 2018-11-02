BEGIN
   SET @lValue = elValue;
   SET @lValue2 = @lValue;
   SET @lValue3 = @lValue;
   SET @lValue4 = @lValue;
   SET @lValue5 = @lValue;
   SET @lValue6 = @lValue;
   SET @lValue7 = @lValue;
   SET @lValue8 = @lValue;
   SET @lValue9 = @lValue;
   SET @lValor = elOtroValue;
   SET @locVal = locValue;
   SET @precValor = precValue;



   SELECT idanuncio,
          destacado,
          titulo,
          datostecnicos,
          descripcion,
          fecha,
          masinformacion,
          precio,
          ubicacion,
          Imagen,
          categoria,
          subcategoria
     FROM get_Data
    WHERE     (   titulo LIKE CONCAT('%', @lValue, '%')
               OR precio LIKE CONCAT('%', @lValue2, '%')
               OR descripcion LIKE CONCAT('%', @lValue3, '%')
               OR masinformacion LIKE CONCAT('%', @lValue4, '%')
               OR ubicacion LIKE CONCAT('%', @lValue7, '%'))
          AND (subcategoria LIKE CONCAT('%', @lValor, '%'))
          AND (ubicacion LIKE CONCAT('%', @locVal, '%'))
          AND (precio LIKE CONCAT('%', @precValor, '%'));
END