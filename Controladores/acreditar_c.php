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

    if (isset($_POST['credito'])) {
        //variables
        $monto = $_POST['monto'];
        $set_res = 'SET @res = ""';
        $cons = "CALL acreditar($id,$monto,@res)";
        $select_res = "SELECT @res";
        //queries
        $conex->query($set_res);
        $conex->query($cons);
        $bool = $conex->query($select_res);
        //resultado
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