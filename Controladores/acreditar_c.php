<?php
    #verificar si ha iniciado sesion para acceder a esta pagina
    include('../controladores/checksession_c.php');
    
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gioscorp2";

    // Create connection
    $conex = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conex->connect_error) {
        die("Connection failed: " . $conex->connect_error);
    } 
    $id = $_SESSION['id_usuario']; 
    //include check session

        $query = $conex->query("SELECT * FROM usuario where idusuario = ".$id.";");
        $row = mysqli_fetch_array($query); 
            $saldo = $row["saldo"]; 

    if (isset($_POST['credito'])) {
        $monto = $_POST['monto'] + $saldo;
        $cons = "UPDATE usuario SET saldo = ".$monto." WHERE idusuario = ".$id.";";
        $bool = $conex->query($cons);
        if ($bool) { 
            header('Location: http://localhost/proyectodb/php/perfil.php?bool=1&pan=3');
            exit();
        
        } else { 
            header("Location: http://localhost/proyectodb/php/perfil.php?bool=0&pan=3");
            exit();
        }
    }
    mysqli_close($conex); 
?>