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

<?php 
    include('../controladores/navbar_c.php');
    include('/partials/connect.php');
?>
<!-- verificar si ha iniciado sesion para acceder a esta pagina-->
<?php include('../controladores/checksession_c.php'); ?>    
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
    $conn3 = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn3->connect_error) {
        die("Connection failed: " . $conn3->connect_error);
    } 
    $usuarioId = $_SESSION['id_usuario'];
    $convoid = $_GET['convoid'];         
    $convMensajes = "CALL messageThreadSent('$convoid')";
    
    $resultMsg = mysqli_query($conn3, $convMensajes);            

    $row=mysqli_fetch_array($resultMsg);
        $senderName = $row['sender'];
    ?>
    </div>
</div>
<div class="grid-y medium-grid-frame">
    <div class="cell medium-1.5 medium-cell-block-container">
        <div class="grid-x grid-padding-x">
            <div class="cell small-1 medium-2"></div>
            <div class="cell small-10 medium-8 msj_title">
                <h3><?php echo $senderName; ?></h3>
                <span>Anuncio: </span>
            </div>
        </div>
    </div>
    <div class="cell medium-7 medium-cell-block-container">
        <div class="grid-x grid-padding-x">
            <div class="cell small-1 medium-2"></div>
            <div class="cell small-10 medium-8 medium-cell-block-y msj_container">
                <?php
                    if(isset($_SESSION['loggedin'])){
    
        
                        $usuarioId = $_SESSION['id_usuario'];
                        $convoid = $_GET['convoid'];         
                        $convMensajes = "CALL messageThreadSent('$convoid')";
                        
                        $resultMsg = mysqli_query($conn, $convMensajes);            
            
                        while($row=mysqli_fetch_array($resultMsg)){
                            $senderName = $row['sender'];
                            $receiverName = $row['receiver'];
                            $mensaje = $row['mensaje'];
                            $fecha =$row['fecha'];
                            $me = $receiverName;
                            
                            echo '<div class="callout ';
                                if ($senderName != $me) {
                                    echo "msj_sent";
                                }
                                else {
                                    echo "msj_received";
                                }
                                echo '">';
                                    echo $mensaje;
                                    echo '<span class="msj_time">'.$fecha.'</span>
                            </div>';
                
                        }
                }
                ?>
            </div>
            <div class="cell medium-2"></div>
        </div>
    </div>
    <div class="cell medium-3 medium-cell-block-container">
        <div class="grid-x grid-padding-x">
            <div class="cell small-1 medium-2"></div>
            <form class="cell small-10 medium-8 callout">
                <div class="input-group">
                    <input id='msj_texto' type="text" />
                    <div class="input-group-button">
                        <button id='msj_button' type="submit" class="button"><i class="fi-play"></i></button>
                    </div>
                </div>
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
<?php
mysqli_close($conn);
?>
