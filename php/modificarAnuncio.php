<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gio's Company - Add</title>
    <link rel="stylesheet" href="../css/foundation.css">
    <link rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" href="../css/css.css">
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "gioscorp2";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $idanuncio = 62;
        //querys para poblar los selects
        $con_cat = $conn->query("SELECT * FROM categorias");
        $con_subcat = $conn->query("SELECT * FROM subcategorias");
        $con_ubic = $conn->query("SELECT * FROM ubicaciones");
        //query para obtener la imagen del anuncio
        $imagen = $conn->query("SELECT Imagen from anuncio where idanuncio=$idanuncio limit 1;"); 
        //arrays de categorias y sub categorias
        $cat_arr = array();
        $subcat_arr = array();

        //Poblar arrays para mostrar las categorias y sub categorias
        $i = 0;
        $j = 0;
        while (($col = mysqli_fetch_array( $con_cat ))){  
            $cat_arr[$i] = array($col[0],$col[1]);
            $i = $i + 1;
        }
        while ($col2 = mysqli_fetch_array( $con_subcat )){
            $subcat_arr[$j] = array($col2[0],$col2[1],$col2[2]);
            $j = $j + 1;
        }
        $count_cat = count($cat_arr);
        $count_subcat = count($subcat_arr);
        //insertar la imagen del anuncio en $imagenanuncio
        while($row = mysqli_fetch_array($imagen))  
                {  
                     $imagenanuncio = '<img class="thumbnail imagendeanuncio" src="data:image/jpeg;base64,'.base64_encode($row['Imagen'] ).'" width=400  />';  
                }  
                

    ?>
  </head>
  <body>
    <!-- incluye al navegador-->
    <?php include('../controladores/navbar_c.php') ?>
    <!-- verificar si ha iniciado sesion para acceder a esta pagina-->
    <?php include('../controladores/checksession_c.php') ?>
      <?php
            
            $prueba = $conn->query("SELECT * from anuncio where idanuncio=$idanuncio limit 1;");
                $row = $prueba->fetch_assoc(); 
                $titulob = $row["titulo"];
                $descripcionb = $row["descripcion"];
                $datostecnicosb = $row["datostecnicos"];
                $masinformacionb = $row["masinformacion"];
                $subcategoriab = $row["idsubcategoria"];
                $ubicacionb = $row["idubicacion"];
                $telefonob = $row["telefono"];
                
       ?>
  <?php /* include('/partials/NavigationBar.php') */?>
  <form class= "grid-container" action="modificarAnuncio.php" method="post" enctype="multipart/form-data">
      <div class="grid-x grid-margin-x align-center">
        <div class= "cell small-12 medium-8">
            <h4 class="text-center">Ingresa los datos</h4>
            Título del anuncio:<br>
            <input type="text" name="tituloa" value="<?php echo $titulob ?>" placeholder="ingrese el numero de departamento">
            <br>
            Descripción:<br>
            <textarea type="text" name="descripciona" value="" placeholder="ingrese el numero de departamento"><?php echo $descripcionb ?></textarea>
            <br>
            Datos Técnicos:<br>
            <textarea type="text" name="datostecnicosa" value="" placeholder="ingrese el numero de departamento"><?php echo $datostecnicosb ?></textarea>
            <br>
            Más informacián:<br>
            <textarea type="text" name="masinfo" value="" placeholder="ingrese el numero de departamento"><?php echo $masinformacionb ?></textarea>
            <br>
            Categoría:<br>
            <select name="subcategoriaa">
                <?php
                    for ($i=0; $i < $count_cat ; $i++) { 
                        echo "<optgroup label=".$cat_arr[$i][1].">";
                        for ($k=0; $k < $count_subcat; $k++) { 
                            if ($cat_arr[$i][0]==$subcat_arr[$k][1]) {
                                echo "<option value=".$subcat_arr[$k][0].">".$subcat_arr[$k][2]."</option>";
                            }
                        }
                    }
                ?>
            </select>
            <br>
            Ubicación:<br>
            <select name="ubicaciona">
                <?php
                    while ($col = mysqli_fetch_array( $con_ubic ))
                    {
                        echo "<option value='".$col[0]."'>".$col[1]."</option>";
                    }
                ?>
            </select>
            <br>
            Teléfono de contacto:<br>
            <input type="text" name="telefonoa" value="<?php echo $telefonob ?>" placeholder="ingrese el numero de departamento">
            <br>
            Imagen:<br>
            <div class= "grid-container">
                <div class="grid-x grid-margin-x align-center">
                    <div class= "cell small-12 medium-6">
                        <input type="file" name="image"/>
                    </div>
                    <div class= "cell small-12 medium-6">
                        <?php
                        //mostrar la imagen del anuncio $imagenanuncio
                        echo $imagenanuncio;
                            
                            /*while($row = mysqli_fetch_array($imagen))  
                            {  
                                echo '  
            
                                    <img class="thumbnail prueba" src="data:image/jpeg;base64,'.base64_encode($row['Imagen'] ).'"  />    
                                ';  
                            }  */
                            ?>
                    </div>
                </div>
            </div>        
            <br>
            <input class="button small-12 cell" type="submit" name="submit" value="Modificar Anuncio"/>
          </div>
        </div>
    </form>

    <?php
        if (isset($_POST["submit"]) && $_FILES["image"]['size']!=0) {

            $check = getimagesize($_FILES["image"]["tmp_name"]);
                if($check /*!== false*/){
                    $dataTime = date("Y-m-d H:i:s");
                    $titulo = $_POST["tituloa"];
                    $descripcion = $_POST["descripciona"];
                    $datostecnicos = $_POST["datostecnicosa"];
                    $masinformacion = $_POST["masinfo"];
                    $subcategoria = $_POST["subcategoriaa"];
                    $ubicacion = $_POST["ubicaciona"];
                    $telefono = $_POST["telefonoa"];
                    $image = $_FILES['image']['tmp_name'];
                    $imgContent = addslashes(file_get_contents($image));

                    //Insert image content into database
                    $insert = $conn->query("UPDATE anuncio set titulo = '$titulo', descripcion ='$descripcion', idsubcategoria = '$subcategoria', idubicacion = '$ubicacion', telefono = '$telefono', Imagen = '$imgContent', datostecnicos ='$datostecnicos', masinformacion = '$masinformacion' where idanuncio = $idanuncio");
                    if($insert){
                        echo "File uploaded successfully.";
                    }else{
                        echo "File upload failed, please try again.";
                        //echo $insert;
                }
            }
        }elseif(isset($_POST["submit"])){
            $titulo = $_POST["tituloa"];
            $descripcion = $_POST["descripciona"];
            $datostecnicos = $_POST["datostecnicosa"];
            $masinformacion = $_POST["masinfo"];
            $subcategoria = $_POST["subcategoriaa"];
            $ubicacion = $_POST["ubicaciona"];
            $telefono = $_POST["telefonoa"];

            $insert = $conn->query("UPDATE anuncio set titulo = '$titulo', descripcion ='$descripcion', idsubcategoria = '$subcategoria', idubicacion = '$ubicacion', telefono = '$telefono', datostecnicos ='$datostecnicos', masinformacion = '$masinformacion' where idanuncio = $idanuncio");
            if ($insert){
                echo "nice";
            } else {
                echo "fail"; echo $insert;
            }
                    /*$dataTime = date("Y-m-d H:i:s");
                    $titulo = $_POST["tituloa"];
                    $descripcion = $_POST["descripciona"];
                    $categoria = $_POST["categoriaa"];
                    $subcategoria = $_POST["subcategoriaa"];
                    $ubicacion = $_POST["ubicaciona"];
                    $telefono = $_POST["telefonoa"];

                    $insert = $conn->query("UPDATE anuncio set titulo = $titulo, where idanuncio = 1");                    if($insert){
                        echo "File uploaded successfully.";
                    }else{
                        echo "File upload failed, please try again. -image";
                        echo $titulo;
                        //echo $insert;*/
                //}

        }
        $conn->close();
    ?>

    <?php include('/partials/Footer.php') ?>


    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>