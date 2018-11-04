<?php include('/partials/connect.php') ?>
<!-- verificar si ha iniciado sesion para acceder a esta pagina-->
<?php //include('../controladores/checksession_c.php'); ?>    

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
        if(isset($_POST['idanuncio'],$_POST['idcomprador'],$_POST['idvendedor'],$_POST['message'])){
                    
            $idad = $_POST['idanuncio'];
            $idbuy = $_POST['idcomprador'];
            $idsell = $_POST['idvendedor'];
            $mssg = $_POST['message'];
                
        $sqlNewMsg = "CALL newMsg('$idad',$idbuy,$idsell,'$mssg')";
        $newConvo=mysqli_query($conn, $sqlNewMsg);
        
        echo "Mensaje enviado";   
        }
    }
    header('Location: http://localhost/proyectodb/php/myconversations.php');
mysqli_close($conn);
?>
