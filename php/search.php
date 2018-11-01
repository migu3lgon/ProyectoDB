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

    //querys para poblar los selects
    $con_cat = $conn->query("SELECT * FROM categorias");
    $con_subcat = $conn->query("SELECT * FROM subcategorias");
    $con_ubic = $conn->query("SELECT * FROM ubicaciones");

    //arrays de categorias y sub categorias
    $cat_arr = array();
    $subcat_arr = array();
    $ubic_arr = array();
    $hglobal;

    //Poblar arrays para mostrar las categorias y sub categorias
    $i = 0; $j = 0; $h = 0;
    while (($col = mysqli_fetch_array( $con_cat ))){  
        $cat_arr[$i] = array($col[0],$col[1]);
        $i = $i + 1;
    }
    while ($col2 = mysqli_fetch_array( $con_subcat )){
        $subcat_arr[$j] = array($col2[0],$col2[1],$col2[2]);
        $j = $j + 1;
    }
    while ($col3 = mysqli_fetch_array( $con_ubic )){
        $ubic_arr[$h] = array($col3[0],$col3[1]);
        $h = $h + 1;
        $hglobal=$h;
    }
    
    $count_cat = count($cat_arr);
    $count_subcat = count($subcat_arr);
    $count_ub = count($ubic_arr);
    
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