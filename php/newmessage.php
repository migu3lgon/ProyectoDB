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
            //echo "search value: ".$valorglo."<br>"; 
            $value=$_GET['vendid'];
            echo "El id del anuncio es: $value";
                $getusr = "CALL getUserInfo('$value')";
                $userRes = mysqli_query($conn,$getusr);
                    echo "<br>El id del vendedor es: ";
                    $row = $userRes->fetch_assoc();
                    echo $row['idusuario'];
                $vendorId = $row['idusuario'];
                $compraId = $_SESSION['id_usuario'];
                echo "<br>El id del comprador es: $compraId";
                /*$sqlart = "SELECT titulo FROM anuncio WHERE idanuncio=$value";
                $adRes = mysqli_query($conn,$sqlart);*/
                

        echo "<div id='newmsg'>";
        echo '
        
            <form action="/convo.php" method="GET">
            <!--<h4>Mensaje relacionado al anuncio: </h4>-->
            <!-- : <input id="subje" placeholder="Ingrese el sujeto" type="text" name="subject">
            <br>-->
            <textarea rows="4" cols="50" placeholder="Ingrese su mensage" name="message" ></textarea>
            <input type="submit" name="submit" Value="Enviar Mensaje">
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

<?php
/*
        $sql12 = "SELECT idanuncio, a.idusuario, nombre, apellido FROM anuncio a INNER JOIN usuario b ON a.idusuario=b.idusuario WHERE idanuncio=$value";
        $result12=mysqli_query($conn, $sql12);
        echo "<table><tr> <th>idanuncio</th><th>iduser</th><th>nombre</th><th>apellido</th></tr>";
        while($row=mysqli_fetch_array($result12)){
            $idad = $row['idanuncio'];
            $iduser =$row['idusuario'];
            $name = $row['nombre'];
            $apellido = $row['apellido'];
           
            
                  echo "<tr>\n"; 
              	  echo "<td>" . "<a  href=\"anuncio.php?id_add=$idad\">"   .$idad . "</td><td> " . $iduser .  "</td><td> " . $name .  "</td><td> " . $apellido .  "</td>\n"; 
                  echo "</tr>";
        }        
                  echo "</table>";
        */

            //$sqlmsg = "CALL newMsg('','','')"
?>