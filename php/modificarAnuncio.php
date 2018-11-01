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
    <link rel="stylesheet" href="../css/foundation-icons/foundation-icons.css">
    <script src="../js/vendor/jquery.js"></script>    
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
        if (isset($_GET['id_add'])) {
            $idanuncio = $_GET['id_add'];
        }
        else {
            echo '<script language="javascript"> alert("Tienes que elegir un anuncio!") </script>';
            header('Location: http://localhost/proyectodb/php/index.php');
            exit();
        }
        //query para obtener la imagen del anuncio
        $imagen = $conn->query("SELECT Imagen from anuncio where idanuncio=$idanuncio limit 1;"); 
        //insertar la imagen del anuncio en $imagenanuncio
        while($row = mysqli_fetch_array($imagen))  
        {  
                $imagenanuncio = '<img class="thumbnail imagendeanuncio" src="data:image/jpeg;base64,'.base64_encode($row['Imagen'] ).'" width=400  />';  
        }     
    ?>
    <script src='../js/nuevo_add.js'></script>
  </head>
  <body>
    <!-- incluye al navegador-->
    <?php include('../controladores/navbar_c.php') ?>
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
                $preciob = $row["precio"];
                
       ?>
  <form class= "grid-container" action="modificarAnuncio.php" method="post" enctype="multipart/form-data">
      <div class="grid-x grid-margin-x align-center">
        <div class= "cell small-12 medium-8">
            <h4 class="text-center">Ingresa los datos</h4>
            Título del anuncio:<br>
            <input type="text" name="tituloa" value="<?php echo $titulob ?>" placeholder="Ingrese aqui el titulo de su anuncio">
            <br>
            Precio del articulo:<br>
            <input type="text" name="precioa" value="<?php echo $preciob ?>" placeholder="Ingrese aqui el Precio de su articulo " pattern="[0-9]+">
            <br>
            Descripción:<br>
            <textarea type="text" name="descripciona" value="" placeholder="Ingrese aqui la descripcion de su anuncio"><?php echo $descripcionb ?></textarea>
            <br>
            Datos Técnicos:<br>
            <textarea type="text" name="datostecnicosa" value="" placeholder="Ingrese aqui los datos tecnicos del producto"><?php echo $datostecnicosb ?></textarea>
            <br>
            Más informacián:<br>
            <textarea type="text" name="masinfo" value="" placeholder="que mas decea indicar sobre su producto?"><?php echo $masinformacionb ?></textarea>
            <br>
            Categoría:<br>
            <select id='subc' name="subcategoriaa">
            </select>
            <br>
            Ubicación:<br>
            <select id='ubic' name="ubicaciona">
            </select>
            <br>
            Teléfono de contacto:<br>
            <input type="text" name="telefonoa" value="<?php echo $telefonob ?>" placeholder="ej: 54638126">
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
                    $precio = $_POST["precioa"];
                    $descripcion = $_POST["descripciona"];
                    $datostecnicos = $_POST["datostecnicosa"];
                    $masinformacion = $_POST["masinfo"];
                    $subcategoria = $_POST["subcategoriaa"];
                    $ubicacion = $_POST["ubicaciona"];
                    $telefono = $_POST["telefonoa"];
                    $image = $_FILES['image']['tmp_name'];
                    $imgContent = addslashes(file_get_contents($image));

                    //Insert image content into database
                    $insert = $conn->query("UPDATE anuncio set titulo = '$titulo', descripcion ='$descripcion', idsubcategoria = '$subcategoria', idubicacion = '$ubicacion', telefono = '$telefono', Imagen = '$imgContent', datostecnicos ='$datostecnicos', masinformacion = '$masinformacion', precio = '$precio' where idanuncio = $idanuncio");
                    if($insert){
                        echo '<script language="javascript"> alert("Archivo subido exitosamente") </script>';
                    }else{
                        echo '<script language="javascript"> alert("Hubo con problema, inténtalo de nuevo") </script>';
                    }
            }
        }elseif(isset($_POST["submit"])){
            $titulo = $_POST["tituloa"];
            $precio = $_POST["precioa"];
            $descripcion = $_POST["descripciona"];
            $datostecnicos = $_POST["datostecnicosa"];
            $masinformacion = $_POST["masinfo"];
            $subcategoria = $_POST["subcategoriaa"];
            $ubicacion = $_POST["ubicaciona"];
            $telefono = $_POST["telefonoa"];

            $insert = $conn->query("UPDATE anuncio set titulo = '$titulo', descripcion ='$descripcion', idsubcategoria = '$subcategoria', idubicacion = '$ubicacion', telefono = '$telefono', datostecnicos ='$datostecnicos', masinformacion = '$masinformacion' where idanuncio = $idanuncio");
            if($insert){
                echo '<script language="javascript"> alert("Archivo modificado exitosamente") </script>';
            }else{
                echo '<script language="javascript"> alert("Hubo con problema, inténtalo de nuevo") </script>';
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

    <script src="../js/vendor/what-input.js"></script>
    <script src="../js/vendor/foundation.js"></script>
    <script src="../js/app.js"></script>
  </body>
</html>