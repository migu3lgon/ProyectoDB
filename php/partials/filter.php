<?php
    $usuario = "root";
    $contrasena = "";
    $servidor = "localhost";
    $basededatos = "gioscorp2";

    $conexion = mysqli_connect($servidor,$usuario,$contrasena) or die("No se ha podido conectar al servidor de base de datos.");
    $db = mysqli_select_db($conexion, $basededatos) or die("Parece que ha habido un error.");
?>


    <div class="mainb" align="center">
        <div class="grid-container">
            
        <?php
        if(isset($_GET['subcat'])){
            $valuecito = $_GET['search'];
            echo $valuecito;
         $sql1 = "SELECT * FROM subcategorias";
         $result1=mysqli_query($conexion, $sql1);
        
        
            
         echo '<form action="search.php" method="GET">';
         //echo '<input type="text" name="searchval" value='.$valuecito.' disabled="disabled">';
         while($row1=mysqli_fetch_array($result1)){
            $subcategoria =$row1['subcategoria'];
            
            echo '<input type="radio" name="subcat" value="'.$subcategoria.'">'.$subcategoria.'<br>';
            //echo "sub es: ".$subcategoria;
            
         }
         echo '<button type="submit" class="button">Filter</button>';
         echo "</form>"; 
         
        }
        ?>
        
        
         
        </div>
    </div>

    
