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
        if(isset($_GET['vendid'])){
                    
            $valorglo = $_GET['vendid'];
            $advalue=$_GET['vendid'];
            //echo "El id del anuncio es: $advalue";
                $getusr = "CALL getUserInfo('$advalue')";
                $userRes = mysqli_query($conn,$getusr);
                    //echo "<br>El id del vendedor es: ";
                    {$row = $userRes->fetch_assoc();
                    //echo $row['idusuario'];
                $vendorId = $row['idusuario'];}
                $compraId = $_SESSION['id_usuario'];
                //echo "<br>El id del comprador es: $compraId";
                
                

        echo "<div id='newmsg'>";
        echo '
        
            <form action="newconvo.php" method="POST">
            <!--<h4>Mensaje relacionado al anuncio: </h4>-->
            <!-- : <input id="subje" placeholder="Ingrese el sujeto" type="text" name="subject">
            <br>-->
            <input type="hidden" name="idanuncio"value="'.$advalue.'">
            <input type="hidden" name="idcomprador"value="'.$compraId.'">
            <input type="hidden" name="idvendedor"value="'.$vendorId.'">
            <textarea rows="4" cols="50" placeholder="Ingrese su mensage" name="message"  required></textarea>
            <input type="submit" name="submit" Value="Enviar">
            </form>
        
        </div>
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
