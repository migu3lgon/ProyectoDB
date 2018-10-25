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
$con_cat = $conn->query("SELECT * FROM categorias");

//Poblar arrays para mostrar las categorias y sub categorias
$i = 0; 
while (($col = mysqli_fetch_array( $con_cat ))){  
    $cat_arr[$i] = array($col[0],$col[1]);
    $cat_json[$i] = array($cat_arr[$i][0],$cat_arr[$i][1]);
    $i = $i + 1;
}

$json = $cat_json;
echo json_encode($json);

$conn->close();
?>