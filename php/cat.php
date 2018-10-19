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
</head>
<body>
    <?php include('../controladores/navbar_c.php') ?>
    <div class="mainb" align="center">
        <div class="grid-container"> 
        <!---->
        <div class="grid-x grid-padding-x small-up-2 medium-up-3">
        <?php 
        for ($k=0; $k < $count_subcat; $k++) { 
            if ($_GET['cat']==$subcat_arr[$k][1]) {
                echo '
                <div class="cell">
                <a href="view_p.php?subcat='.$subcat_arr[$k][1].'">
                    <div class="card">
                        <img src="https://placehold.it/180x180">
                        <div class="card-section">
                        <h4>'.$subcat_arr[$k][2].'</h4>
                        <p>Description</p>
                        </div>
                    </div>
                </a>
                </div>';
            }
        }
        ?> 
        </div>
        </div>  
        <!---->
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