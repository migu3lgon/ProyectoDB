<?php
session_start();
?>

<?php
$host_db = "localhost";
$user_db = "root";
$pass_db = "";
$db_name = "gioscorp2";

$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

if ($conexion->connect_error) {
 die("La conexion falló: " . $conexion->connect_error);
}

$username = $_POST['email'];
$password = $_POST['pswd'];

//Variable para capturar respuesta
$cons1 = "SET @res = '';";
//utilizar procedimiento almacenado para el login
$cons2 = "CALL login('".$username."','".$password."',@res);";
//respuesta del SP
$cons3 = "SELECT @res;";

$conexion->query($cons1) or die("Parece que algo ha salido mal!");
$conexion->query($cons2) or die("Parece que algo ha salido mal!");
$bool = $conexion->query($cons3) or die("Parece que algo ha salido mal!");
    
 
 $row = mysqli_fetch_array( $bool );

 //Si el login es exitoso
 if ($row[0]) { 
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
    

    //Obtener el nombre para la navbar
    $cons4 = "SELECT `nombre` from `usuario` where `correo` ='".$username."';";
    $res = $conexion->query($cons4) or die("Parece que algo ha salido mal!");
    $row = mysqli_fetch_array( $res );
    $_SESSION['name'] = $row[0];

    //Obtener el id para manejo de anuncios
    $cons5 = "SELECT `idusuario` from `usuario` where `correo` ='".$username."';";
    $res2 = $conexion->query($cons5) or die("Parece que algo ha salido mal!");
    $row2 = mysqli_fetch_array( $res2 );
    $_SESSION['id_usuario'] = $row2[0];

    header('Location: http://localhost/proyectodw/php/index.php');
    exit();

 } else { 
    header("Location: http://localhost/proyectodw/php/login.php?login=0");
    exit();
 }
 mysqli_close($conexion); 
 ?>