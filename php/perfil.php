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
            <div class="grid-x grid-margin-x">
                <div class="cell small-12">
                    <ul class="tabs" data-tabs id="example-tabs">
                        <li class="tabs-title is-active"><a href="#panel1" aria-selected="true">Mi Perfil</a></li>
                        <li class="tabs-title"><a href="#panel2">Mis Anuncios</a></li>
                        <li class="tabs-title"><a href="#panel3">Monedero</a></li>
                    </ul>

                    <div class="tabs-content" data-tabs-content="example-tabs">
                        <div class="tabs-panel is-active" id="panel1">
                            <p>One</p>
                            <p>Este es el disenio de miguel</p>
                        </div>
                        <div class="tabs-panel" id="panel2">
                            <div class="grid-container">
                                <?php
                                    $id = $_SESSION['id_usuario'];  
                                        $imagen = $conn->query("SELECT * from anuncio where idusuario=".$id.";");
                                        
                                        while($row = mysqli_fetch_array($imagen))  
                                        {  
                                            if ($row['Imagen'] != NULL) {
                                                $img = '<img class="img_anuncio" src="data:image/jpeg;base64,'.base64_encode($row['Imagen'] ).'"  alt="imagen producto"/>';  
                                            }
                                            else {
                                                $img = '<img class="img_anuncio" src="../Imagenes/Sin_imagen_disponible.jpg"  alt="Sin imagen"/>';
                                            }
                                            if ($row['descripcion']!= NULL) {
                                                $prodDesc = $row['descripcion'];
                                            }
                                            else {
                                                $prodDesc = "Sin descripcion.";
                                            }
                                            $prodName = $row['titulo'];
                                            $prodPrice = $row['precio'];
                                            $prodID = $row['idanuncio'];
                                            echo    '<div class="grid-x grid-margin-x align-middle">
                                                        <div class="cell small-12 medium-3 large-3">
                                                            <h4>'.$prodName.'</h4>
                                                            <br>
                                                            <h4>Q '.$prodPrice.'</h4>
                                                        </div>
                                                        <div class="cell small-12 medium-3 large-3">
                                                            <p> '.$prodDesc.'</p>
                                                        </div>
                                                        <div class="cell small-12 medium-3 large-3 anuncio">
                                                            '.$img.'
                                                        </div>
                                                        <div class="cell small-12 medium-3 large-3">
                                                        <a href="anuncio.php?id_add='.$prodID.'"><button class="button expanded">Ver</button></a>
                                                        echo '.$prodID.';
                                                        <br>
                                                        <a href="#" class="button expanded">Modificar</a>
                                                        </div>
                                                      </div>
                                                <hr>

                                        ';
                                        }  
                                        
                                        /*<div class="cell small-12 medium-3">
                                            <div class="product-card cont">
                                                <div class="product-card-thumbnail anuncio">
                                                    <a href="#">';echo $img.'</a>
                                                </div>
                                                <h2 class="product-card-title cont"><a href="#">';echo $prodName.'</a></h2>
                                                <span class="product-card-desc">';echo $prodDesc.'</span>
                                                <br/>
                                                <span class="product-card-price">Q ';echo $prodPrice.'</span>
                                                <br/>
                                                <button class="button">Comprar</button>
                                                <button class="button">Informacion</button>
                                            </div>
                                        </div>*/
                                ?>
                                </div>
                                
                                <hr>
                            </div>
                        </div>
                        <div class="tabs-panel" id="panel3">
                            <p>Three</p>
                            <p>Check me out! I'm a super cool Tab panel with text content!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('/partials/Footer.php') ?>

    <script src="../js/vendor/jquery.js"></script>
    <script src="../js/vendor/what-input.js"></script>
    <script src="../js/vendor/foundation.js"></script>
    <script src="../js/app.js"></script>

</body>
</html>
<?php
    mysqli_close($conn);
?>