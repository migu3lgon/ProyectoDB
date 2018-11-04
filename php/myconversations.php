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
    }
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
    $conn2 = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn2->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    if(isset($_SESSION['loggedin'])){
        echo '<center>
            
            <strong>Welcome '.$_SESSION['username'].'</strong>
        </center>';}
        else {
            echo '<center>
            
            <strong>Por favor inicie sesion</strong><br>
        </center>'; 
        }
    if(isset($_SESSION['loggedin'])){
        
            
            $usuarioId = $_SESSION['id_usuario'];            
            $convSell = "CALL getConvSell('$usuarioId')";
            $convBuy = "CALL getConvBuy('$usuarioId')"; 
            $resultSell = mysqli_query($conn, $convSell);
            $resultBuy = mysqli_query($conn2, $convBuy);
            if (!$resultBuy) {
                printf("Error: %s\n", mysqli_error($conn2));
                //exit();
            }
            //echo $resultSell;
            //echo $resultBuy;

            echo '
            <table id="customers">Mensajes a mis anuncios
            <tr>
                <th>Anuncio</th>
                <th>Comprador</th>
            </tr>
            ';
            while($row=mysqli_fetch_array($resultSell)){
                $adsId = $row['idanuncio'];
                $title =$row['titulo'];
                $nameBuyer = $row['nombre'];
                $idBuyer = $row['idcomprador']; 
                $convoid = $row['idconversacion'];
                
                echo '
                <tr>
                    <td>
                    <a href="messages.php?convoid='.$convoid.'&contype=0">'.$title.'</a>
                    </td>
                    <td><a href="messages.php?convoid='.$convoid.'&contype=0">'.$nameBuyer.'</a>
                    </td>
                    
                </tr>';
  
            }
            echo '</table>';
            echo '
            <table id="customers">Mensajes a otros anuncios
            <tr>
                <th>Anuncio</th>
                <th>Vendedor</th>
            </tr>
            ';
            while($row=mysqli_fetch_array($resultBuy)){
                $adsId2 = $row['idanuncio'];
                $title2 =$row['titulo'];
                $nameSeller = $row['nombre'];
                $idSeller = $row['idvendedor'];
                $convoid = $row['idconversacion'];    

                echo '
                <tr>
                    <td>
                    <a href="messages.php?convoid='.$convoid.'&contype=1">'.$title2.'</a>
                    </td>
                    <td><a href="messages.php?convoid='.$convoid.'&contype=1">'.$nameSeller.'</a>
                    </td>
                    
                </tr>';
            }
            echo '</table>';
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
