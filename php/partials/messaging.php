<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gio's Company - Add</title>
    <link rel="stylesheet" href="../css/foundation.css">
    <link rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" href="../css/css.css">
    <link rel="stylesheet" href="../css/foundation-icons/foundation-icons.css">
    <script src="../js/vendor/jquery.js"></script>
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
    
  </head>
  <body>
    <!-- incluye al navegador-->
    <?php include('../controladores/navbar_c.php'); ?>
    <!-- verificar si ha iniciado sesion para acceder a esta pagina-->
    <?php include('../controladores/checksession_c.php'); ?>

  <div class= "grid-container">
      <div class="grid-x grid-margin-x align-center">
        
        </div>
    </div>
    <?php
        $id = $_SESSION['id_usuario'];
        
        
        $conn->close();
    ?>

    <?php include('/partials/Footer.php') ?>

    
    <script src="../js/vendor/jquery.js"></script>
    <script src="../js/vendor/what-input.js"></script>
    <script src="../js/vendor/foundation.js"></script>
    <script src="../js/app.js"></script>
  </body>
</html>