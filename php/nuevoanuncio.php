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
        //querys para poblar los selects
        $con_cat = $conn->query("SELECT * FROM categorias");
        $con_subcat = $conn->query("SELECT * FROM subcategorias");
        $con_ubic = $conn->query("SELECT * FROM ubicaciones");
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

    ?>
  </head>
  <body>
  <!-- verificar si ha iniciado sesion para acceder a esta pagina-->
  <?php include('../controladores/checksession_c.php') ?>
  <!-- incluye al navegador-->
  <?php include('../controladores/navbar_c.php') ?>
  <form class= "grid-container" action="nuevoanuncio.php" method="post" enctype="multipart/form-data">
      <div class="grid-x grid-margin-x align-center">
        <div class= "cell small-12 medium-8">
            Título del anuncio:<br>
            <input type="text" name="tituloa" value="" placeholder="ingrese el numero de departamento">
            <br>
            Descripción:<br>
            <input type="text" name="descripciona" value="" placeholder="ingrese el numero de departamento">
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
            ubicación:<br>
            <select name="ubicaciona">
                <?php
                    while ($col = mysqli_fetch_array( $con_ubic ))
                    {
                        echo "<option value='".$col[0]."'>".$col[1]."</option>";
                    }
                ?>
            </select>
            <br>
            teléfono de contacto:<br>
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