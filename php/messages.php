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
    $conn3 = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn3->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    if(isset($_SESSION['loggedin'])){
        echo '<center>
            
            <strong>Welcome '.$_SESSION['username'].'</strong>
        </center>';

        
        
            $anuid;
            $idrec;
            $idse;
            $usuarioId = $_SESSION['id_usuario'];
            
            $convoid = $_GET['convoid'];    
            $convMensajes = "CALL messageThreadSent('$convoid')";
            
            $resultMsg = mysqli_query($conn, $convMensajes);
            $resultMsg2 = mysqli_query($conn2, $convMensajes);
            $resultMsg3 = mysqli_query($conn3, $convMensajes);

            echo '
            <table id="customers">
            <tr>
                <th>Mensaje para</th>
                <th>Mensaje de</th>
                <th>Mensaje</th>
                <th>Fecha y hora</th>
                <th>Anuncio</th>
            </tr>
            ';
            while($row=mysqli_fetch_array($resultMsg)){
                $senderName = $row['sender'];
                $receiverName = $row['receiver'];
                $mensaje = $row['mensaje'];
                $fecha =$row['fecha'];
                $titulo = $row['title'];
                $dir = $row['direccion'];
                
                
                if(isset($dir)){
                echo '
                <tr>
                    <td>'.$senderName.'</td>
                    <td>'.$receiverName.'</td>
                    <td>'.$mensaje.'</td>
                    <td>'.$fecha.'</td>
                    <td>'.$titulo.'</td>
                    
                </tr>';
                }
            }
            echo '
            <br><table id="customers">
            <tr>
                <th>Mensaje para</th>
                <th>Mensaje de</th>
                <th>Mensaje</th>
                <th>Fecha y hora</th>
                <th>Anuncio</th>
            </tr>
            ';
            while($row=mysqli_fetch_array($resultMsg3)){
                $senderName = $row['sender'];
                $receiverName = $row['receiver'];
                $mensaje = $row['mensaje'];
                $fecha =$row['fecha'];
                $titulo = $row['title'];
                $dir = $row['direccion'];
                
                
                if(isset($dir)){
                }
                else {
                    echo '<tr>
                    <td>'.$receiverName.'</td>
                    <td>'.$senderName.'</td>
                    <td>'.$mensaje.'</td>
                    <td>'.$fecha.'</td>
                    <td>'.$titulo.'</td>
                    
                </tr>';
                }
            }
            echo '</table>';
            /*$anuid;
            $idrec;
            $idse; */      
            {$row2 = $resultMsg2->fetch_assoc();        
                $idrec = $row2['idcomprador'];
                $idse = $row2['idvendedor'];
                $anuid = $row2['anuncad'];
                $convosid = $row2['idconversacion'];
                /*echo $idrec;
                echo $anuid;
                echo $idse;*/

                
            echo "<div id='newmsg'>";
            echo '
            
                <form action="newAnsMsg.php" method="POST">
                <!--<h4>Mensaje relacionado al anuncio: </h4>-->
                <!-- : <input id="subje" placeholder="Ingrese el sujeto" type="text" name="subject">
                <br>-->
                <input type="hidden" name="convosid" value="'.$convosid.'">
                <input type="hidden" name="idanuncio" value="'.$anuid.'">
                <input type="hidden" name="idcomprador" value="'.$idse.'">
                <input type="hidden" name="idvendedor" value="'.$idrec.'">
                
                <textarea rows="4" cols="50" placeholder="Ingrese su mensage" name="message"  required></textarea>
                <input type="submit" name="submit" Value="Enviar">
                </form>
            
            </div>
            ';}
                    
            
            echo '<form action="myconversations.php">
                <input type="submit" value="Regresar a mensajes" />
            </form>';
        }
        else {
            echo '<center>
            
            <strong>Por favor inicie sesion</strong><br>
        </center>'; 
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
