DROP IF EXISTS VIEW get_Data;
CREATE OR REPLACE DEFINER = `root` @`localhost` SQL SECURITY DEFINER VIEW gioscorp2.get_Data
(
   idanuncio,
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
)
AS
     SELECT idanuncio,
          destacado,
          titulo,
          datostecnicos,
          descripcion,
          fecha,
          masinformacion,
          precio,
          d.ubicacion,
          Imagen,
          c.categoria,
          b.subcategoria
     FROM anunciodestacado a
          INNER JOIN subcategorias b ON a.idsubcategoria = b.idsubcategoria
          INNER JOIN categorias c ON b.idcategoria = c.idcategoria
          INNER JOIN ubicaciones d ON a.idubicacion = d.idubicacion