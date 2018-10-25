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

    $con_prod = $conn->query("SELECT * from anuncio ORDER BY destacado DESC");
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
    <title>Gio's Company - Home</title>
    <link rel="stylesheet" href="../css/foundation.css">
    <link rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" href="../css/css.css">
</head>
<body>
    <?php include('../controladores/navbar_c.php') ?>
    <div class="mainb" align="center">
        <div class="grid-container">
            
    <?php include('partials/filter.php') ?>
        
        <?php 
        $valorglo;
                {
                if(isset($_GET['search'])){
                    
                    $valorglo = $_GET['search'];
                    echo "search value: ".$valorglo; 
                    $value=$_GET['search'];
                    
                    $sql = "CALL getData('$value')";
                    $result=mysqli_query($conn, $sql);
/*
                    echo '
                    <form action="/search.php" method="get">
                    <input type="hidden" name="search" value="'.$valorglo.'">

                    <input type="checkbox" name="vehicle" value="Car" checked> I have a car<br>
                    <input type="submit" value="Submit">
                    </form>
                    ';
                    */

                    echo '<div class="grid-x grid-margin-x grid-margin-y">';
                    
                    while($row=mysqli_fetch_array($result)){
                        $title =$row['titulo'];
                        $tecData = $row['datostecnicos'];
                        $date=$row['fecha']; 
                        $moreInfo = $row['masinformacion'];
                        $price = $row['precio'];
                        $ubicacion = $row['ubicacion'];
                        $categoria = $row['categoria'];
                        $subcategoria = $row['subcategoria'];
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
                    </div>';} echo '</div>';}}
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
    mysqli_close($conn);
?>