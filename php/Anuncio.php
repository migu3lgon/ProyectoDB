
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
    <?php include('/partials/connect.php') 
    /*$servername = "ns8481.hostgator.com";
    $username = "yosoyman_connect";
    $password = "conn1234!";
    $dbname = "yosoyman_gioscorp";*/?>
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
        <div class="grid-container">
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
                        <a class="button" data-open="compra">comprar</a>
                        <a href="newmessage.php?vendid=<?php echo $idanuncio ?>" class="button">contactar vendedor</a>
                </div>
            </div>
        </div>
        <div class="reveal" id="compra" data-reveal>
            <div class="grid-container">
                <form action="../controladores/compra_c.php?id_add=<?php echo "$idanuncio"?>" class="grid-x" method="post" enctype="multipart/form-data">
                    <div class="small-12 cell">
                        <h3>Compra de Producto</h3>
                    </div>
                    <div class="small-12 cell">
                        <h4>Precio</h4>
                    </div>
                    <div class="small-12 cell">
                        <h3 id="precio2">Q </h3>
                    </div>
                    <div class="small-12 cell">
                        <h4>Información de la tarjeta:</h4>
                    </div>
                    <div class="input-group small-8 cell">
                        <span class="input-group-label">Titular:</span>
                        <input class="input-group-field" type="cvv" name='titular' pattern="[A-Za-z]+" placeholder="Nombre del titular de la tarjeta">
                    </div>
                    <div class="input-group small-4 cell">
                        <span class="input-group-label">cvv:</span>
                        <input class="input-group-field" type="cvv" name='cvv' pattern="[0-9]{3,4}" placeholder="### or ####">
                    </div>
                    <div class="input-group small-12 cell">
                        <span class="input-group-label">Tarjeta:</span>
                        <input class="input-group-field" type="card" name="tarjeta" placeholder="Ingrese el numero de la tarjeta" pattern="[0-9]+">
                    </div>
                    <div class="input-group small-12 cell">
                        <span class="input-group-label">Fecha de Vencimiento:</span>
                        <input class="input-group-field" type="month" name='fecha_vencimiento'>
                    </div>
                    <input class="button small-12 cell success" type="submit" name="comprar" value="comprar" />
                </form>
            </div>
            <button class="close-button" data-close aria-label="Close modal" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
    </div>
    <?php include('/partials/Footer.php') ?>

    <script src="../js/vendor/what-input.js"></script>
    <script src="../js/vendor/foundation.js"></script>
    <script src="../js/app.js"></script>

</body>
</html>