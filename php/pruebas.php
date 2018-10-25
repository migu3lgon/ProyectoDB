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
    <link rel="stylesheet" href="../css/foundation-icons/foundation-icons.css">
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
    <style>
        .prueba {
            display: block;
            margin-left: auto;
            width: 400px;
            float: right;
        }
    </style>
  </head>
  <body>
  <!-- incluye al navegador-->
  <!-- verificar si ha iniciado sesion para acceder a esta pagina-->
  <form class= "grid-container" action="pruebas.php" method="post" enctype="multipart/form-data">
      <div class="grid-x grid-margin-x align-center">
        <div class= "cell small-12 medium-8">
            Titulo del anuncio:<br>
            <input type="text" name="tituloa" value="" placeholder="Ingrese aqui el titulo de su anuncio">
            <br>
            Descripcion:<br>
            <textarea type="text" name="descripciona" value="" placeholder="Ingrese aqui su descripcion del producto"></textarea>
            <br>
            Datos tecnicos:<br>
            <textarea type="text" name="datostecnicosa" value="" placeholder="ingrese datos tecnicos del producto"></textarea>
            <br> 
            Mas informacion:<br>
            <textarea type="text" name="masinfo" value="" placeholder="que mas decea indicar sobre su producto?"></textarea>
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
            telefo de contacto:<br>
            <input type="text" name="telefonoa" value="" placeholder="ej: 54638126" pattern="[0-9]+">
            <br>
            Imagen:<br>
            <div class= "grid-container" action="pruebas.php" method="post" enctype="multipart/form-data">
                <div class="grid-x grid-margin-x align-center">
                <div class= "cell small-6 medium-6">
            <input type="file" name="image"/>  
            </div>
            <div class= "cell small-6 medium-6">
            <?php
                $result = $conn->query("SELECT * from anuncio where idanuncio=74 limit 1;"); 
                while($row = mysqli_fetch_array($result))  
                {  
                     echo '  
  
                        <img class="thumbnail prueba" src="data:image/jpeg;base64,'.base64_encode($row['Imagen'] ).'"  />    
                     ';  
                }  
                ?>
                </div>
                </div>
            </div>

            <br>
            <input class="button small-12 cell" type="submit" name="submit" id="submit" value="SUBIR"/>
          </div>
        </div>
    </form>

    

    
    <?php
        $id = 3;
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
                    $insert = $conn->query("INSERT into anuncio (titulo, descripcion, idsubcategoria, idubicacion, Imagen, vendido, destacado, telefono, fecha, idusuario, datostecnicos, masinformacion) 
                        VALUES ('$titulo','$descripcion',$subcategoria,$ubicacion,'$imgContent',0,0,$telefono, '$dataTime', '$id', '$datostecnicos', '$masinformacion')");
                    if($insert){
                        echo "File uploaded successfully.";
                    }else{
                        echo "File upload failed, please try again.";
                        //echo $insert;
                }
            }
        }/*elseif(isset($_POST["submit"])){
                    $dataTime = date("Y-m-d H:i:s");
                    $titulo = $_POST["tituloa"];
                    $descripcion = $_POST["descripciona"];
                    $datostecnicos = $_POST["datostecnicosa"];
                    $masinformacion = $_POST["masinfo"];
                    $subcategoria = $_POST["subcategoriaa"];
                    $ubicacion = $_POST["ubicaciona"];
                    $telefono = $_POST["telefonoa"];

                    $insert = $conn->query("INSERT into anuncio (titulo, descripcion, idsubcategoria, idubicacion, Imagen, vendido, destacado, telefono, fecha, idusuario, datostecnicos, masinformacion) 
                        VALUES ('$titulo','$descripcion',$subcategoria,$ubicacion,null,0,0,$telefono, '$dataTime',  '$id', '$datostecnicos', '$masinformacion')");
                    if($insert){
                        echo "File uploaded successfully. -image";
                    }else{
                        echo "File upload failed, please try again.";
                        //echo $insert;
                }

        }*/
        $conn->close();
    ?>

    <?php include('/partials/Footer.php') ?>


    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
    <script>  
 $(document).ready(function(){  
      $('#submit').click(function(){  
           var image_name = $('#submit').val();  
           if(image_name == '')  
           {  
                alert("Please Select Image");  
                return false;  
           }  
           else  
           {  
                var extension = $('#submit').val().split('.').pop().toLowerCase();  
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
                {  
                     alert('Invalid Image File');  
                     $('#submit').val('');  
                     return false;  
                }  
           }  
      });  
 });  
 </script>  
  </body>
</html>