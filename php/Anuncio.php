
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gio's Company - Anuncio</title>
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
        while($row = mysqli_fetch_array($imagen))  
        {  
            $imagenanuncio = '<img class="thumbnail imagendeanuncio" src="data:image/jpeg;base64,'.base64_encode($row['Imagen'] ).'"  />';  
        }  
    ?>
    <script>
        var globalVariable={
        idadd: <?php echo $idanuncio;?>
        };
    </script>
    <script src='../js/anuncio.js'></script>
</head>
<body>
    <?php include('../controladores/navbar_c.php'); ?>
    
    <div class="mainb">
    <h1 id='titulo' align="center"></h1> 
        <article class="grid-container">
            <div class="grid-x grid-margin-x align-center">
                <div class="small-10 medium-6 cell">
                    <?php echo $imagenanuncio; ?>
                </div>
                <div class="small-10 medium-4 cell">
                    <h2>Precio:</h2>
                    <span id= "precio">Q </span>
                    <h2>Informacion General</h2>
                    <p id='descr'></p>
                    <h2>Datos Tecnicos</h2>
                    <p id='dat_t'></p>
                </div>
                <div class="small-10 cell">
                    <h3>Mas Informacion</h3>
                    <p id='mas_info'></p>
                </div>
                <div id="bones de anuncio" class="cell small-10 button-group">
                        <a class="button">comprar</a>
                        <a href="newmessage.php?vendid=<?php echo $idanuncio ?>" class="button">contactar vendedor</a>
                </div>
            </div>
        </article>
        
    </div>
    <?php include('/partials/Footer.php') ?>

    <script src="../js/vendor/what-input.js"></script>
    <script src="../js/vendor/foundation.js"></script>
    <script src="../js/app.js"></script>

</body>
</html>