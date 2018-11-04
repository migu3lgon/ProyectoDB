<?php include('/partials/connect.php') ?>
<?php
    

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
    $con_prod = $conn->query("SELECT * from anunciodestacado WHERE idsubcategoria=$subcat ORDER BY destacado DESC");
    //arrays de categorias y sub categorias
    $prod_arr = array();

    //Poblar arrays para mostrar las categorias y sub categorias
    $j = 0;
    while ($col2 = mysqli_fetch_array( $con_prod )){
        $prod_arr[$j] = array($col2['titulo'],$col2['descripcion'],$col2['Imagen'],$col2['precio'],$col2['idanuncio'],$col2['destacado']);
        $j = $j + 1;
    }
    $count_prod = count($prod_arr);
?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gio's Company - Productos</title>
    <link rel="stylesheet" href="../css/foundation.css">
    <link rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" href="../css/css.css">
    <link rel="stylesheet" href="../css/foundation-icons/foundation-icons.css">
    <script src="../js/vendor/jquery.js"></script>
</head>
<body>
    <?php include('../controladores/navbar_c.php') ?>
    <?php include('../controladores/checksession_c.php') ?>
    <div class="mainb" align="center">
        <div class="grid-container">
            <div class="grid-x grid-margin-x grid-margin-y">
                <?php 
                    if ($count_prod <= 0) {
                        echo '
                        <div class="callout small-10 medium-10 large-10 align">
                            <h5>Más anuncios proximamente!</h5>
                            <p>Actualmente esta categoría no posee ningún anuncio, vuelve a intentarlo más tarde</p>
                        </div>
                        ';
                    }
                    for ($i=0; $i < $count_prod ; $i++) { 
                        if ($prod_arr[$i][2] != NULL) {
                            $img = '<img class="img_anuncio" src="data:image/jpeg;base64,'.base64_encode($prod_arr[$i][2]).'" width=400  alt="imagen producto"/>';  
                        }
                        else {
                            $img = '<img class="img_anuncio" src="https://placehold.it/180x180" alt="Sin imagen"/>';
                        }
                        if ($prod_arr[$i][1]!= NULL) {
                            $prodDesc = $prod_arr[$i][1];
                        }
                        else {
                            $prodDesc = "Sin descripcion.";
                        }
                        $prodName = $prod_arr[$i][0];
                        $prodPrice = $prod_arr[$i][3];
                        $prodID = $prod_arr[$i][4];
                        //destacado
                        $dest = $prod_arr[$i][5];
                        //imprimir el producto
                        echo '
                            <div class="cell small-12 medium-3">
                                <div class="product-card cont">
                                    <div class="product-card-thumbnail anuncio">
                                        <a href="anuncio.php?id_add='.$prodID.'">'.$img.'</a>
                                    </div>
                                    <h2 class="product-card-title cont"><a href="#">'.$prodName.'</a> ';
                                    if ($dest) {
                                        echo '<i class="fi-star estrella"></i>';
                                    }
                                    echo '</h2>
                                    <span class="product-card-desc">'.$prodDesc.'</span>
                                    <br/>
                                    <span class="product-card-price">Q '.$prodPrice.'</span>
                                    <br/>
                                    <a href="anuncio.php?id_add='.$prodID.'"><button class="button">Comprar</button></a>
                                    <a href="anuncio.php?id_add='.$prodID.'"><button class="button">Informacion</button></a>
                                </div>
                            </div>';
                    }  
                ?> 
            </div>
        </div>
    </div>

    <?php include('/partials/Footer.php') ?>

    <script src="../js/vendor/what-input.js"></script>
    <script src="../js/vendor/foundation.js"></script>
    <script src="../js/app.js"></script>

</body>
</html>
<?php
    mysqli_close($conn);
?>