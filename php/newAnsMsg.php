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
    <link rel="stylesheet" href="../css/foundation-icons/foundation-icons.css">
    <script src="../js/vendor/jquery.js"></script>
</head>
<body>

<?php include('../controladores/navbar_c.php') ?>
<?php include('/partials/connect.php') ?>
<!-- verificar si ha iniciado sesion para acceder a esta pagina-->
<?php //include('../controladores/checksession_c.php'); ?>    
<div class="mainb" align="center">
        <div class="grid-container">
    <?php
    
    if(isset($_SESSION['loggedin'])){
    echo '<center>
        
        <strong>Welcome '.$_SESSION['username'].'</strong>
    </center>';}
    else {
        echo '<center>
        
        <strong>Por favor inicie sesion</strong><br>
    </center>'; 
    }
    ?>
    
    <?php
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    if(isset($_SESSION['loggedin'])){
        if(isset($_POST['idanuncio'],$_POST['idcomprador'],$_POST['idvendedor'],$_POST['message'],$_POST['convosid'])){
            $conv = $_POST['convosid'];    
            $idad = $_POST['idanuncio'];
            $idbuy = $_POST['idcomprador'];
            $idsell = $_POST['idvendedor'];
            $mssg = $_POST['message'];
                
       $sqlNewMsg = "CALL answMsg('$idad',$idbuy,$idsell,'$mssg')";

        $newConvo=mysqli_query($conn, $sqlNewMsg);
        //echo $newConvo;
        echo "Mensaje enviado";
        echo "<br>";
        /*echo $idad; 
        echo '<br>';
        echo $idbuy;
        echo '<br>';
        echo $idsell;*/

        echo '<a href="messages.php?convoid='.$conv.'">Regresar al hilo de mensajes</a>
        '; 
        }
    }
    
    ?>

    
     
    
    </div></div>
 <?php include('/partials/Footer.php') ?>

<script src="../js/vendor/what-input.js"></script>
<script src="../js/vendor/foundation.js"></script>
<script src="../js/app.js"></script>

</body>
</html>
<?php
mysqli_close($conn);
?>
