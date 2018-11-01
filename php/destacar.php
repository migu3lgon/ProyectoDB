<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gio's Company - Informacion</title>
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
        
        //$id = $_SESSION['id_usuario']; 
        if (isset($_GET['id_add'])) {
            $idanuncio = $_GET['id_add'];
        }
        else {
            $idanuncio = 75;
        }
        session_start();
        $id = $_SESSION['id_usuario'];
        $datosu = $conn->query("select * from usuario where idusuario = $id;");
        $row = $datosu->fetch_assoc(); 
            $saldo = $row["saldo"];
        session_abort();
        
        $datosa = $conn->query("call obtener_anuncio(".$idanuncio.");");
        $row2 = $datosa->fetch_assoc(); 
            $titulo = $row2["titulo"];
            $uid = $row2["idusuario"];
    ?>
</head>
<body>

    <!-- incluye al navegador-->
    <?php include('../controladores/navbar_c.php'); ?>
    <!-- verificar si ha iniciado sesion para acceder a esta pagina-->
    <?php include('../controladores/checksession_c.php'); ?>
    <div class="mainb">
    <div class= "grid-container">
        <div class="grid-x grid-margin-x align-center">
            <form class= "cell small-12 medium-8" action="../controladores/destacado_c.php?<?php echo "id_add=$idanuncio"?>" method="post">
            <h2>Destacar Anuncio</h2>
                <h3><?php echo $titulo ?></h3>
                <input type="hidden" id="id" name="id" value=<?php echo $id ?>>
                <input type="hidden" id="id2" name="id2" value=<?php echo $uid ?>>
                Fercha para inicio de destacado:
                <input type="date" name="fechainicio" min="2018-10-22" value="2018-10-22">
                Fecha para fin de destacado:
                <input type="date" name="fechafin"  value="2018-11-01">
                Monedero:
                <span> Q <?php echo $saldo ?></span>
                <br>
                Costo por dia:
                <span> Q 10</span>
                <input class="button small-12 cell" type="submit" name="submit" value="Destacar" />
            </form>
        </div>
    </div>
        
    </div>
    <?php include('/partials/Footer.php') ?>
    
    <script src="../js/vendor/what-input.js"></script>
    <script src="../js/vendor/foundation.js"></script>
    <script src="../js/app.js"></script>

</body>
</html>