<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gioscorp2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//querys para poblar los selects
$con_ubic = $conn->query("SELECT * FROM ubicaciones");

//Poblar arrays para mostrar las categorias y sub categorias
$h = 0;
while ($col3 = mysqli_fetch_array( $con_ubic )){
    $ubic_json[$h] = array($col3[0],$col3[1]);
    $h = $h + 1;
}

$json = $ubic_json;
echo json_encode($json);

$conn->close();
?>