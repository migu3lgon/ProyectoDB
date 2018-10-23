<?php
    $usuario = "root";
    $contrasena = "";
    $servidor = "localhost";
    $basededatos = "gioscorp2";

    $conexion = mysqli_connect($servidor,$usuario,$contrasena) or die("No se ha podido conectar al servidor de base de datos.");
    $db = mysqli_select_db($conexion, $basededatos) or die("Parece que ha habido un error.");
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
</head>
<body>
    <?php include('../controladores/navbar_c.php') ?>
    <div class="mainb" align="center">
        <div class="grid-container">
            
        <?php 
                
                if(isset($_GET['search'])){
                    
                    $valor = $_GET['search'];
                    echo "search value: ".$valor; 
                    $value=$_GET['search']; 
                  
                    $sql = "CALL getData('$value')";
                    $result=mysqli_query($conexion, $sql);
                    /*echo '
                    <form action="search.php">
                    <h6>Categoria</h6>
                    <input type="checkbox" name="vehicle1" value="Bike"> I have a bike
                    <input type="checkbox" name="vehicle2" value="Car"> I have a car
                    <input type="checkbox" name="vehicle3" value="Boat" checked> I have a boat
                    <input type="submit" value="Filter">
                    </form>';*/

                    echo '<div class="grid-x grid-margin-x grid-margin-y">';
                    
                    while($row=mysqli_fetch_array($result)){
                        $title =$row['titulo'];
                        $tecData = $row['datostecnicos'];
                        $date=$row['fecha']; 
                        $moreInfo = $row['masinformacion'];
                        $price = $row['precio'];
                        $image = $row['Imagen'];
                        if ($row['Imagen'] != NULL) {
                            $img = '<img class="img_anuncio" src="data:image/jpeg;base64,'.base64_encode($row['Imagen'] ).'" width=400  alt="imagen producto"/>';  
                        }
                        else {
                            $img = '<img class="img_anuncio" src="https://placehold.it/180x180" alt="Sin imagen"/>';
                        }
                        if ($row['descripcion']!= NULL) {
                            $description = $row['descripcion'];
                        }
                        else {
                            $description = "Sin descripcion.";
                        }      
              
                    echo 
                    '
                    <div class="cell small-12 medium-3">
                        <div class="product-card">
                            <div class="product-card-thumbnail">
                                <a href="#">'.$img.'</a>
                            </div>
                            <h2 class="product-card-title"><a href="#">'.$title.'</a></h2>
                            <span class="product-card-desc">'.$description.'</span>
                            <br/>
                            <span class="product-card-price">$'.$price.'</span>
                            <br/>
                            <button class="button">Comprar</button>
                            <button class="button">Informacion</button>
                        </div>
                    </div>';} echo '</div>';}
        ?> 
         
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
    mysqli_close($conexion);
?>