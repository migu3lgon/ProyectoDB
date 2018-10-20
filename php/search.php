<?php
    $usuario = "root";
    $contrasena = "";
    $servidor = "localhost";
    $basededatos = "gioscorp2";

    $conexion = mysqli_connect($servidor,$usuario,$contrasena) or die("No se ha podido conectar al servidor de base de datos.");
    $db = mysqli_select_db($conexion, $basededatos) or die("Parece que ha habido un error.");
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
        
        <?php 

                if(isset($_POST['search'])){ 
                        
                        

                    $value=$_POST['search']; 
                        
                    //echo $sql;
                    $sql = "CALL getData('$value')";
                    $result=mysqli_query($conexion, $sql);
                    
                    /*
                    echo "<tr>\n";  
                    echo "<table><tr> <th>Titulo</th><th>Datos tecnicos</th><th>Descripcion</th><th>Fecha</th><th>Mas informacion</th></tr>";
                    
                        while($row=mysqli_fetch_array($result)){ 
                                    $title =$row['titulo'];
                                    $tecData = $row['datostecnicos'];
                                    $description = $row['descripcion'];
                                    $date=$row['fecha']; 
                                    $moreInfo = $row['masinformacion'];
                                    
                            //-display the result of the array 
                            echo "<tr>\n"; 
                            echo "<td>"   .$title . "</td><td> " . $tecData .  "</td><td> " . $description .  "</td><td> " . $date .  "</td><td> " . $moreInfo .  "</td>\n"; 
                            echo "</tr>"; 

                        
                    } 
                    
                    echo "</table>";*/
                    for ($i=0; $i < 6; $i++){
                    while($row=mysqli_fetch_array($result)){
                                    $title =$row['titulo'];
                                    $tecData = $row['datostecnicos'];
                                    $description = $row['descripcion'];
                                    $date=$row['fecha']; 
                                    $moreInfo = $row['masinformacion'];
                                    $price = $row['precio'];

                                    
                    echo 
                    '
                    <div class="grid-x grid-margin-x grid-margin-y">
                    <div class="cell small-12 medium-3">
                        <div class="product-card">
                            <div class="product-card-thumbnail">
                                <a href="#"><img src="https://placehold.it/180x180"/></a>
                            </div>
                            <h2 class="product-card-title"><a href="#">'.$title.'</a></h2>
                            <span class="product-card-desc">'.$description.'</span>
                            <br/>
                            <span class="product-card-price">$'.$price.'</span>
                            <br/>
                            <button class="button">Comprar</button>
                            <button class="button">Informacion</button>
                        </div>
                    </div>
                    </div>';
                    }}

                                        
                            }
            
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
    mysqli_close($conexion);
?>