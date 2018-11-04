<?php include('/partials/connect.php') 


    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $con_prod = $conn->query("SELECT * from anunciodestacado ORDER BY destacado DESC");
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
    $hglobal;

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
        $hglobal=$h;
    }
    
    $count_cat = count($cat_arr);
    $count_subcat = count($subcat_arr);
    $count_ub = count($ubic_arr);
?>

<?php 
        $valorglo;
        $catglo;
        $catglo2;
        $locglo;
        $locglo2;
        $precglo;
        $precglo2;
                {
                if(isset($_GET['search'])){
                    
                    $valorglo = $_GET['search'];
                    //echo "search value: ".$valorglo."<br>"; 
                    $value=$_GET['search'];
                    {
                        if(isset($_GET['subcategoria'])){
                        $catglo = $_GET['subcategoria'];
                        //$catglo = $valSub;
                        //echo "cat value: ".$catglo."<br>";
                        }
                        else {
                            $catglo=NULL;
                            $catglo2=NULL;
                        }
                    }
                    {
                        if(isset($_GET['ubicacion'])){
                        $locglo = $_GET['ubicacion'];
                        //$locglo = $valLoc;
                        //echo "locat value: ".$locglo."<br>";
                        
                        }
                        else {
                            $locglo=NULL;
                            $locglo2=NULL;
                        }
                    }
                    {
                        if(isset($_GET['precio'])){
                        $precglo = $_GET['precio'];
                        //$precglo = $valPrec;
                        //echo "price value: ".$precglo;
                        }
                        else {
                            $precglo=NULL;
                            $precglo2=NULL;
                        }
                    }
                    
                    echo "<div id='filtrado'>";
                    echo '
                    <form action="search.php" method="get">
                    <input type="hidden" name="search" value="'.$valorglo.'">';
                    /*echo '<select id="subc" name="subcategoriaa">
                    </select>';
                    echo "<select id='ubic'";
                    echo 'name="ubicaciona">
                    </select>';*/
                    echo '
                        <select name="subcategoria">
                        <option value="'.$catglo.'" disabled selected>';
                        //echo '<option value=""></option>';
                        echo '</option>';
                                echo '<option value="'.$catglo.'" selected>Categoria: '.$catglo.'</option>';
                                for ($i=0; $i < $count_cat ; $i++) { 
                                    echo "<optgroup label=".$cat_arr[$i][1].">";
                                    for ($k=0; $k < $count_subcat; $k++) { 
                                        if ($cat_arr[$i][0]==$subcat_arr[$k][1]) {
                                            echo '<option value="'.$subcat_arr[$k][2].'">'.$subcat_arr[$k][2].'</option>';
                                        }
                                    }
                                }
                                echo '<option value=""></option>';
                           
                        echo '</select>';
                    echo '<select name="ubicacion">
                    <option value="'.$locglo.'" disabled selected>';
                    echo '</option>';
                            echo '<option value="'.$locglo.'" selected>Ubicacion: '.$locglo.'</option>';
                            for ($l=0; $l < $hglobal; $l++) { 
                                echo '<option value="'.$ubic_arr[$l][0].'">'.$ubic_arr[$l][1].'</option>';
                            }
                            echo '<option value=""></option>';
                    echo '</select>';
                    /*if($locglo2!=NULL){
                    echo '<input type="hidden" name="subcategoria" value="'.$locglo2.'">';}*/
                    echo '
                    Precio < 
                    <input type="text" name="precio" value="'.$precglo.'">';
                    
                                   
                    
                    echo '<input type="submit" value="Submit">
                    
                    </form></br></br>
                    
                    ';
                    echo '</div>';

                    echo '<div class="grid-x grid-margin-x grid-margin-y">';
                    /*if(isset($_GET['search'])){
                    switch($_GET['search']){
                        case isset($_GET['subcategoria']):
                            $sql = "CALL getData('$value','$catglo','','')";
                            break;
                        case isset($_GET['ubicacion']):
                            $sql = "CALL getData('$value','','$locglo','')";
                            break;
                        case isset($_GET['precio']):
                            $sql = "CALL getData('$value','','','$precglo')";
                            break;
                        case isset($_GET['subcategoria'],$_GET['precio']):
                            $sql = "CALL getData('$value','$catglo','','$precglo')";
                            break;
                        case isset($_GET['ubicacion'],$_GET['subcategoria']):
                            $sql = "CALL getData('$value','$catglo','$locglo','')";
                            break;
                        case isset($_GET['ubicacion'],$_GET['precio']):
                            $sql = "CALL getData('$value','','$locglo','$precglo')";
                            break;
                        case isset($_GET['ubicacion'],$_GET['subcategoria'],$_GET['precio']):
                            $sql = "CALL getData('$value','$catglo','$locglo','$precglo')";
                            break;
                        case isset($_GET['search']):
                            $sql = "CALL getData('$value','','','')";
                            break;


                    }}*/
                        if(isset($_GET['search'])){
                            //agregar variables que me permitan saber si estan nulos o no
                            if(isset($_GET['precio']) && $locglo ==NULL && $catglo==NULL){
                                $sql = "CALL getData('$value','','','$precglo')";
                            }
                            else if(isset($_GET['ubicacion']) && $precglo ==NULL && $catglo==NULL){
                                $sql = "CALL getData('$value','','$locglo','')";
                            }
                            else if(isset($_GET['subcategoria']) && $locglo ==NULL && $precglo==NULL){
                                $sql = "CALL getData('$value','$catglo','','')";
                                }
                            else if(isset($_GET['subcategoria'],$_GET['precio']) && $locglo ==NULL){
                                $sql = "CALL getData('$value','$catglo','','$precglo')";
                            } 
                            else if(isset($_GET['ubicacion'],$_GET['subcategoria']) && $precglo ==NULL){
                                $sql = "CALL getData('$value','$catglo','$locglo','')";
                            }
                            else if(isset($_GET['ubicacion'],$_GET['precio']) && $catglo ==NULL){
                                $sql = "CALL getData('$value','','$locglo','$precglo')";
                            }
                            else if(isset($_GET['ubicacion'],$_GET['subcategoria'],$_GET['precio'])){
                                $sql = "CALL getData('$value','$catglo','$locglo','$precglo')";
                            } 
                            else {
                                $sql = "CALL getData('$value','','','')";
                            }
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
                        
                
                }}}
        ?> 
    
