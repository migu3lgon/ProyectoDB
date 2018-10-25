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
$con_subcat = $conn->query("SELECT * FROM subcategorias");

//Poblar arrays para mostrar las categorias y sub categorias
$i = 0; $j = 0; 
while (($col = mysqli_fetch_array( $con_cat ))){  
    $cat_arr[$i] = array($col[0],$col[1]);
    $cat_json[$i] = array($cat_arr[$i][0],$cat_arr[$i][1]);
    $i = $i + 1;
}

while ($col2 = mysqli_fetch_array( $con_subcat )){
    $subcat_arr[$j] = array($col2[0],$col2[1],$col2[2]);
    $subcat_json[$j] = array($subcat_arr[$j][0],$subcat_arr[$j][1],$subcat_arr[$j][2]);
    $j = $j + 1;
}

$json['cat'] = $cat_json;
$json['subcat'] = $subcat_json;
echo json_encode($json);

$conn->close();
?>