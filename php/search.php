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

    $con_prod = $conn->query("SELECT * from anuncio ORDER BY destacado DESC");
    //arrays de categorias y sub categorias
    $prod_arr = array();

    //Poblar arrays para mostrar las categorias y sub categorias
    $j = 0;
    while ($col2 = mysqli_fetch_array( $con_prod )){
        $prod_arr[$j] = array($col2['titulo'],$col2['descripcion'],$col2['Imagen'],$col2['precio'],$col2['idanuncio'],$col2['destacado']);
        $j = $j + 1;
    }
    $count_prod = count($prod_arr);

    //querys para poblar los selects
    $con_cat = $conn->query("SELECT * FROM categorias");
    $con_subcat = $conn->query("SELECT * FROM subcategorias");
    $con_ubic = $conn->query("SELECT * FROM ubicaciones");
    //arrays de categorias y sub categorias
    $cat_arr = array();
    $subcat_arr = array();
    $ubic_arr = array();

    //Poblar arrays para mostrar las categorias y sub categorias
    $i = 0; $j = 0; $h = 0;
    while (($col = mysqli_fetch_array( $con_cat ))){  
        $cat_arr[$i] = array($col[0],$col[1]);
        $i = $i + 1;
    }
    while ($col2 = mysqli_fetch_array( $con_subcat )){
        $subcat_arr[$j] = array($col2[0],$col2[1],$col2[2]);
        $j = $j + 1;
    }
    while ($col3 = mysqli_fetch_array( $con_ubic )){
        $ubic_arr[$h] = array($col3[0],$col3[1]);
        $h = $h + 1;
    }
    $count_cat = count($cat_arr);
    $count_subcat = count($subcat_arr);
    $count_ub = count($ubic_arr);
?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gio's Company - Home</title>
    <link rel="stylesheet" href="../css/foundation.css">
    <link rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" href="../css/css.css">
</head>
<body>
<?php include('../controladores/navbar_c.php') ?>
    <div class="mainb" align="center">
        <div class="grid-container">
            
    <?php/* include('partials/filter.php') */?>
        
        <?php 
        $valorglo;
        $catglo;
                {
                if(isset($_GET['search'])){
                    
                    $valorglo = $_GET['search'];
                    echo "search value: ".$valorglo."<br>"; 
                    $value=$_GET['search'];
                    if(isset($_GET['subcategoria'])){
                    $valSub = $_GET['subcategoria'];
                    $catglo = $valSub;
                    echo "cat value: ".$catglo;}
                    

                    echo '
                    <form action="search.php" method="get">
                    <input type="hidden" name="search" value="'.$valorglo.'">';
                    echo '
                        <select name="subcategoria">';
                            
                                for ($i=0; $i < $count_cat ; $i++) { 
                                    echo "<optgroup label=".$cat_arr[$i][1].">";
                                    for ($k=0; $k < $count_subcat; $k++) { 
                                        if ($cat_arr[$i][0]==$subcat_arr[$k][1]) {
                                            echo "<option value=".$subcat_arr[$k][2].">".$subcat_arr[$k][2]."</option>";
                                        }
                                    }
                                }
                           
                        echo '</select>';
                    
                                   

                    echo '<input type="submit" value="Submit">
                    </form>
                    ';
                    

                    echo '<div class="grid-x grid-margin-x grid-margin-y">';
                    if(isset($_GET['subcategoria'])){
                    $sql = "CALL getData('$value','$catglo','')";}
                    else {
                        $sql = "CALL getData('$value','','')";
                    }
                    $result=mysqli_query($conn, $sql);

                    while($row=mysqli_fetch_array($result)){
                        $prodId = $row['idanuncio'];
                        $title =$row['titulo'];
                        $tecData = $row['datostecnicos'];
                        $date=$row['fecha']; 
                        $description = $row['descripcion'];
                        $moreInfo = $row['masinformacion'];
                        $price = $row['precio'];
                        $ubicacion = $row['ubicacion'];
                        $dest = $row['destacado'];
                        //$categoria = $row['categoria'];
                        //$subcategoriaAlgo = $row['subcategoria'];
                        $image = $row['Imagen'];
                        
                        if ($row['Imagen'] != NULL) {
                            $img = '<img class="img_anuncio" src="data:image/jpeg;base64,'.base64_encode($row['Imagen']).'" width=400  alt="imagen producto"/>';  
                        }
                        else {
                            $img = '<img class="img_anuncio" src="https://placehold.it/180x180" alt="Sin imagen"/>';
                        }
                        if ($row['descripcion']!= NULL) {
                            $description = $row['descripcion'];
                        }
                        else {
                            $description = "Sin descripcion.";
                        }
                        
                        
                    
                        //imprimir el producto
                        echo '
                        <div class="cell small-12 medium-3">
                            <div class="product-card cont">
                                <div class="product-card-thumbnail anuncio">
                                    <a href="anuncio.php?id_add='.$prodId.'">'.$img.'</a>
                                </div>
                                <h2 class="product-card-title cont"><a href="#">'.$title.'</a> ';
                                if ($dest) {
                                    echo '<i class="fi-star estrella"></i>';
                                }
                                echo '</h2>
                                <span class="product-card-desc">'.$description.'</span>
                                <br/>
                                <span class="product-card-price">Q '.$price.'</span>
                                <br/>
                                <button class="button">Comprar</button>
                                <a href="anuncio.php?id_add='.$prodId.'"><button class="button">Informacion</button></a>
                            </div>
                        </div>';
                        /*    
              
                    echo 
                    '
                    <div class="cell small-12 medium-3">
                        <div class="product-card">
                            <div class="product-card-thumbnail">
                                <a href="#">'.$img.'</a>
                            </div>
                            <h2 class="product-card-title"><a href="#">'.$title.'</a></h2>
                            <span class="product-card-desc">'.$description.'</span>
                            <br/>
                            <span class="product-card-price">$'.$price.'</span>
                            <br/>
                            <button class="button">Comprar</button>
                            <button class="button">Informacion</button>
                        </div>
                    </div>';} echo '</div>';*/
                
                }}}
        ?> 
         
        </div>
    </div>

    <?php include('/partials/Footer.php') ?>

    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>

</body>
</html>
<?php
    mysqli_close($conn);
?>