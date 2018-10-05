<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foundation for Sites</title>
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
    ?>
  </head>
  <body>
  <?php include('/partials/NavigationBar.php') ?>
  <form class= "grid-container" action="nuevoanuncio.php" method="post" enctype="multipart/form-data">
      <div class="grid-x grid-margin-x align-center">
        <div class= "cell small-12 medium-8">
            Titulo del anuncio:<br>

            <input type="text" name="tituloa" value="" placeholder="ingrese el numero de departamento">
            <br>
            Descripcion:<br>
            <input type="text" name="descripciona" value="" placeholder="ingrese el numero de departamento">
            <br>
            categoria:<br>
            <input type="text" name="categoriaa" value="" placeholder="ingrese el numero de departamento">
            <br>
            subcategoria:<br>
            <input type="text" name="subcategoriaa" value="" placeholder="ingrese el numero de departamento">
            <br>
            ubicacion:<br>
            <input type="text" name="ubicaciona" value="" placeholder="ingrese el numero de departamento">
            <br>
            telefo de contacto:<br>
            <input type="text" name="telefonoa" value="" placeholder="ingrese el numero de departamento">
            <br>
            Imagen:<br>
            <input type="file" name="image"/>
            <br>
            <input class="button small-12 cell" type="submit" name="submit" value="SUBIR"/>
          </div>
        </div>
    </form>

    <?php
        if (isset($_POST["submit"])) {

            $check = getimagesize($_FILES["image"]["tmp_name"]);
                if($check /*!== false*/){
                    $dataTime = date("Y-m-d H:i:s");
                    $titulo = $_POST["tituloa"];
                    $descripcion = $_POST["descripciona"];
                    $categoria = $_POST["categoriaa"];
                    $subcategoria = $_POST["subcategoriaa"];
                    $ubicacion = $_POST["ubicaciona"];
                    $telefono = $_POST["telefonoa"];
                    $image = $_FILES['image']['tmp_name'];
                    $imgContent = addslashes(file_get_contents($image));

                    //Insert image content into database
                    $insert = $conn->query("INSERT into anuncio (titulo, descripcion, idsubcategoria, idubicacion, Imagen, vendido, destacado, telefono, fecha, idusuario) VALUES ('$titulo' ,'$descripcion' ,$subcategoria ,$ubicacion ,'$image' ,0,0,$telefono, '$dataTime', 2)");
                    if($insert){
                        echo "File uploaded successfully.";
                    }else{
                        echo "File upload failed, please try again.";
                        //echo $insert;
                }
            }
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