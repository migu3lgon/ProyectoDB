<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gioscorp2";
    /*$servername = "ns8481.hostgator.com";
    $username = "yosoyman_connect";
    $password = "conn1234!";
    $dbname = "yosoyman_gioscorp";*/

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    if (isset($_GET['subcat'])) {
        $subcat = $_GET['subcat'];
        $query = "SELECT * from anunciodestacado WHERE idsubcategoria=$subcat ORDER BY destacado DESC";
    }
    if (isset($_GET['id_add'])) {
        $id_add = $_GET['id_add'];
        $query = "SELECT * from anunciodestacado WHERE idanuncio=$id_add ORDER BY destacado DESC";
    }
    else {
        $query = "SELECT * from anunciodestacado ORDER BY destacado DESC";
    }
    //querys de anuncios para poblar la pagina
    $con_prod = $conn->query($query);
    //arrays de categorias y sub categorias
    $prod_arr = array();

    //Poblar arrays para mostrar las categorias y sub categorias
    $j = 0;
    while ($col2 = mysqli_fetch_array( $con_prod )){
        $prod_arr[$j] = array($col2['titulo'],$col2['descripcion'],$col2['precio'],$col2['datostecnicos'],$col2['masinformacion']);
        $j = $j + 1;
    }
    
    $json = $prod_arr;
    echo json_encode($json);

    $conn->close();
?>