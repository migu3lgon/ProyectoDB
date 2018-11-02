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
    <?php include('/partials/connect.php') ?>
    <?php
        

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
    ?>
    <script src='../js/nuevo_add.js'></script>
  </head>
  <body>
    <!-- incluye al navegador-->
    <?php include('../controladores/navbar_c.php'); ?>
    <!-- verificar si ha iniciado sesion para acceder a esta pagina-->
    <?php include('../controladores/checksession_c.php'); ?>

  <div class= "grid-container">
      <div class="grid-x grid-margin-x align-center">
        <form class= "cell small-12 medium-8" action="nuevoanuncio.php" method="post" enctype="multipart/form-data">
            <h4 class="text-center">Ingresa los datos</h4>
            Título del anuncio:<br>
            <input type="text" name="tituloa" value="" placeholder="Ingrese aqui el titulo de su anuncio">
            <br>
            Precio del articulo:<br>
            <input type="text" name="precioa" value="" placeholder="Ingrese aqui el Precio de su articulo" pattern="[0-9]+">
            <br>
            Descripción:<br>
            <textarea type="text" name="descripciona" value="" placeholder="Ingrese aqui su descripcion del producto"></textarea>
            <br>
            Datos técnicos:<br>
            <textarea type="text" name="datostecnicosa" value="" placeholder="ingrese datos tecnicos del producto"></textarea>
            <br> 
            Más información:<br>
            <textarea type="text" name="masinfo" value="" placeholder="que mas decea indicar sobre su producto?"></textarea>
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
            <input type="text" name="telefonoa" value="" placeholder="ej: 54638126" pattern="[0-9]+">
            <br>
            Imagen:<br>
            <input type="file" name="image"/>   
            <br>
            <input class="button small-12 cell" type="submit" name="submit" value="Guardar Anuncio"/>
          </form>
        </div>
    </div>
    <?php
        $id = $_SESSION['id_usuario'];
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
                    $insert = $conn->query("INSERT into anuncio (titulo, descripcion, idsubcategoria, idubicacion, Imagen, vendido, telefono, fecha, idusuario, datostecnicos, masinformacion, precio) 
                        VALUES ('$titulo','$descripcion',$subcategoria,$ubicacion,'$imgContent',0,$telefono, '$dataTime', '$id', '$datostecnicos', '$masinformacion', '$precio')");
                    if($insert){
                        echo '<script language="javascript"> alert("Archivo subido exitosamente") </script>';
                    }else{
                        echo '<script language="javascript"> alert("Hubo con problema, inténtalo de nuevo") </script>';
                    }
            }
        }elseif(isset($_POST["submit"])){
                    $dataTime = date("Y-m-d H:i:s");
                    $titulo = $_POST["tituloa"];
                    $precio = $_POST["precioa"];
                    $descripcion = $_POST["descripciona"];
                    $datostecnicos = $_POST["datostecnicosa"];
                    $masinformacion = $_POST["masinfo"];
                    $subcategoria = $_POST["subcategoriaa"];
                    $ubicacion = $_POST["ubicaciona"];
                    $telefono = $_POST["telefonoa"];

                    $insert = $conn->query("INSERT into anuncio (titulo, descripcion, idsubcategoria, idubicacion, Imagen, vendido, telefono, fecha, idusuario, datostecnicos, masinformacion, precio) 
                        VALUES ('$titulo','$descripcion',$subcategoria,$ubicacion,null,0,$telefono, '$dataTime',  '$id', '$datostecnicos', '$masinformacion', '$precio')");
                    if($insert){
                        echo '<script language="javascript"> alert("Archivo subido exitosamente") </script>';
                    }else{
                        echo '<script language="javascript"> alert("Hubo con problema, inténtalo de nuevo") </script>';
                    }
        }
        
        $conn->close();
    ?>

    <?php include('/partials/Footer.php') ?>

    <script src="../js/vendor/what-input.js"></script>
    <script src="../js/vendor/foundation.js"></script>
    <script src="../js/app.js"></script>
  </body>
</html>