<?php
session_start();
$host_db = "localhost";
$user_db = "root";
$pass_db = "";
$db_name = "gioscorp2";
$tbl_name = "destacado";

$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

if ($conexion->connect_error) {
 die("La conexion falló: " . $conexion->connect_error);
}
if (isset($_GET['id_add'])) {
    $idanuncio = $_GET['id_add'];
}
else {
    header('Location: http://localhost/proyectodb/php/perfil.php?err=0');
    exit();
}



//echo $idanuncio;
$id = $_POST['id'];
echo $id, "<br>";
$id2 = $_POST['id2'];
echo $id2, "<br>";
//echo $id;
$fechai = $_POST['fechainicio'];
//echo $fechai;
$fechaf = $_POST['fechafin'];
//echo $fechaf;
if($id != $id2){
    header('Location: http://localhost/proyectodb/php/perfil.php?err=0');
    exit();
    }
$cons1 = "SET @res = '';";
$destacar = $conexion->query("CALL destacar(".$idanuncio.",'".$fechai."','".$fechaf."',".$id.", @res);");
$cons2 = "SELECT @res;";
$bool = $conexion->query($cons2) or die("Parece que algo ha salido mal!");
$row = mysqli_fetch_array( $bool );
$resultado = $row["@res"];
if ($row[0]) { 
    header('Location: http://localhost/proyectodb/php/perfil.php?err=1');
    exit();
    }

if ($destacar) { 
    header('Location: http://localhost/proyectodb/php/perfil.php?destac=1');
    exit();

 } else { 
    header("Location: http://localhost/proyectodb/php/perfil.php?destac=0");
    exit();
 }
 mysqli_close($conexion);


/*//Variable para capturar respuesta
$cons1 = "SET @res = '';";
$sp_call = "CALL cambio_clave('".$email."','".$password."','".$new_passw."',@res)";
$cons3 = "SELECT @res;";

/*$conexion->query($cons1) or die("Parece que algo ha salido mal!");
$conexion->query($sp_call);
$bool = $conexion->query($cons3) or die("Parece que algo ha salido mal!");
  
 
/*$row = mysqli_fetch_array( $bool );

 if ($row['@res']) { 
    header('Location: http://localhost/proyectodb/php/cambiar_clave.php?cambio=1');
    exit();

 } else { 
    header("Location: http://localhost/proyectodb/php/cambiar_clave.php?cambio=0");
    exit();
 }
 mysqli_close($conexion); */
 ?>
