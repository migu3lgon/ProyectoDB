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
    if (isset($_GET['subcat'])) {
        $subcat = $_GET['subcat'];
    }
    //querys de anuncios para poblar la pagina
    $imagen = $conn->query("SELECT * from anuncio where idsubcategoria=$subcat");
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gio's Company - Home</title>
    <link rel="stylesheet" href="../css/foundation.css">
    <link rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" href="../css/css.css">
    <script src='../js/vendor/foundation.js'></script>
</head>
<body>
    <?php include('../controladores/navbar_c.php') ?>
    <div class="mainb" align="center">
        <div class="grid-container">
            <div class="grid-x grid-margin-x grid-margin-y">
                <?php 
                    if (!mysqli_fetch_array($imagen)) {
                        echo '
                        <div class="callout small-10 medium-10 large-10 align">
                            <h5>Más anuncios proximamente!</h5>
                            <p>Actualmente esta categoría no posee ningún anuncio, vuelve a intentarlo más tarde</p>
                        </div>
                        ';
                    }
                    while($row = mysqli_fetch_array($imagen))  
                    {  
                        if ($row['Imagen'] != NULL) {
                            $img = '<img class="img_anuncio" src="data:image/jpeg;base64,'.base64_encode($row['Imagen'] ).'" width=400  alt="imagen producto"/>';  
                        }
                        else {
                            $img = '<img class="img_anuncio" src="https://placehold.it/180x180" alt="Sin imagen"/>';
                        }
                        if ($row['descripcion']!= NULL) {
                            $prodDesc = $row['descripcion'];
                        }
                        else {
                            $prodDesc = "Sin descripcion.";
                        }
                        $prodName = $row['titulo'];
                        $prodPrice = $row['precio'];
                        echo '
                        <div class="cell small-12 medium-3">
                            <div class="product-card cont">
                                <div class="product-card-thumbnail anuncio">
                                    <a href="#">'.$img.'</a>
                                </div>
                                <h2 class="product-card-title cont"><a href="#">'.$prodName.'</a></h2>
                                <span class="product-card-desc">'.$prodDesc.'</span>
                                <br/>
                                <span class="product-card-price">Q '.$prodPrice.'</span>
                                <br/>
                                <button class="button">Comprar</button>
                                <button class="button">Informacion</button>
                            </div>
                        </div>';
                    }  
                ?> 
            </div>
        </div>
    </div>

    <?php include('/partials/Footer.php') ?>

    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>

</body>
</html>
<?php
    mysqli_close($conn);
?>