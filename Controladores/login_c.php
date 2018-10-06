<?php
session_start();
?>

<?php
$host_db = "localhost";
$user_db = "root";
$pass_db = "";
$db_name = "gioscorp2";

$conexion = mysqli_connect($host_db,$user_db,$pass_db) or die("No se ha podido conectar al servidor de base de datos.");
$db = mysqli_select_db($conexion, $db_name) or die("Parece que ha habido un error.");

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

mysqli_query($conexion, $cons1) or die("Parece que algo ha salido mal!");
mysqli_query($conexion, $cons2) or die("Parece que algo ha salido mal!");
$bool = mysqli_query($conexion, $cons3) or die("Parece que algo ha salido mal!");
    
 
 $row = mysqli_fetch_array( $bool );

 if ($row[0]) { 
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);

    header('Location: http://localhost/proyectodw/php/index.php');
    exit();

 } else { 
    header("Location: http://localhost/proyectodw/php/login.php?login=0");
    exit();
 }
 mysqli_close($conexion); 
 ?>