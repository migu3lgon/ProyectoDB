<?php
$host_db = "localhost";
$user_db = "root";
$pass_db = "";
$db_name = "gioscorp2";
$tbl_name = "usuario";

$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);
$conn2 = new mysqli($host_db, $user_db, $pass_db, $db_name);

if ($conexion->connect_error) {
 die("La conexion falló: " . $conexion->connect_error);
}
if ($conn2->connect_error) {
    die("La conexion falló: " . $conexion->connect_error);
   }

$name = $_POST['name'];
$last_n = $_POST['last-n'];
$email = $_POST['email'];
$tel = $_POST['fnum'];
$password = $_POST['pswd'];

//Variable para capturar respuesta
$cons1 = "SET @res = '2';";
$sp_call = "CALL registro('".$email."','".$password."','".$name."','".$last_n."',".$tel.",@res)";
$cons3 = "SELECT @res;";

$conexion->query($cons1) or die("Parece que algo ha salido mal1!");
$conexion->query($sp_call) or die("Parece que algo ha salido mal2!");
$bool = $conexion->query($cons3) or die("Parece que algo ha salido mal!");
  
$row = mysqli_fetch_array( $bool );
echo "hola";
echo $row['@res'];
 if ($row['@res']) { 
    header('Location: http://localhost/proyectodb/php/register.php?register=1');
    exit();

 } else { 
    header("Location: http://localhost/proyectodb/php/register.php?register=0");
    exit();
 }
 mysqli_close($conexion); 
 mysqli_close($conn2); 
 ?>