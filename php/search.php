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
<!-- verificar si ha iniciado sesion para acceder a esta pagina-->
<?php include('../controladores/checksession_c.php') ?>
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