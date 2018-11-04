<?php
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
        
            <form action="../controladores/newconvo.php" method="POST">
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