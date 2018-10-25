<?php
    session_start();
    $host_db = "localhost";
    $user_db = "root";
    $pass_db = "";
    $db_name = "gioscorp2";
    $tbl_name = "usuario";

    $conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

    if ($conexion->connect_error) {
    die("La conexion falló: " . $conexion->connect_error);
    }

    $email = $_SESSION['username'];
    $password = $_POST['pswd'];
    $new_passw = $_POST['pswd_n'];

    //Variable para capturar respuesta
    $cons1 = "SET @res = '';";
    $sp_call = "CALL cambio_clave('".$email."','".$password."','".$new_passw."',@res)";
    $cons3 = "SELECT @res;";

    $conexion->query($cons1) or die("Parece que algo ha salido mal!");
    $conexion->query($sp_call);
    $bool = $conexion->query($cons3) or die("Parece que algo ha salido mal!");
    
    
    $row = mysqli_fetch_array( $bool );

    if ($row['@res']) { 
        header('Location: http://localhost/proyectodb/php/cambiar_clave.php?cambio=1');
        exit();

    } else { 
        header("Location: http://localhost/proyectodb/php/cambiar_clave.php?cambio=0");
        exit();
    }
    mysqli_close($conexion); 
 ?>