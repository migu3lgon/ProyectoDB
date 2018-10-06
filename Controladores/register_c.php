<?php
session_start();
?>

<?php
$host_db = "localhost";
$user_db = "root";
$pass_db = "";
$db_name = "gioscorp2";
$tbl_name = "usuario";

$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

if ($conexion->connect_error) {
 die("La conexion falló: " . $conexion->connect_error);
}

$name = $_POST['name'];
$last_n = $_POST['last-n'];
$email = $_POST['email'];
$tel = $_POST['fnum'];
$password = $_POST['pswd'];

$set_var = "SET @res = '';";
$sp_call = "CALL registro('".$email."','".$password."','".$name."','".$last_n."',".$tel.",@res)";
$sql = "SELECT @res;"

$conexion->query($set_var);
$conexion->query($sp_call);
$bool = $conexion->query($sql);
  
 
$row = mysqli_fetch_array( $bool );

 if ($row['@res']) { 
    header('Location: http://localhost/proyectodw/php/register.php?register=1');
    exit();

 } else { 
    header("Location: http://localhost/proyectodw/php/register.php?register=0");
    exit();
 }
 mysqli_close($conexion); 
 ?>