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
  $con_cat = $conn->query("SELECT * FROM categorias");
  $con_subcat = $conn->query("SELECT * FROM subcategorias");
  //arrays de categorias y sub categorias
  $cat_arr = array();
  $subcat_arr = array();
  $usuario = $_SESSION['username'];
  //Poblar arrays para mostrar las categorias y sub categorias
  $i = 0; $j = 0;
  while (($col = mysqli_fetch_array( $con_cat ))){  
      $cat_arr[$i] = array($col[0],$col[1]);
      $i = $i + 1;
  }
  while ($col2 = mysqli_fetch_array( $con_subcat )){
      $subcat_arr[$j] = array($col2[0],$col2[1],$col2[2]);
      $j = $j + 1;
  }
  $count_cat = count($cat_arr);
  $count_subcat = count($subcat_arr); 

?>
<!--logged navbar-->
<header>
 <!-- Navigation Bar -->
 <div class="top-bar" id="Navigation_Bar">
            <div class="top-bar-left">
                <ul class="menu">
                  <figure>
                        <a href="index.php"><img src="../Imagenes/logo.jpg" class="logo" id="Navigation_Bar_Logo" /></a>
                  </figure>
                  <li><input type="search" placeholder="Search"></li>
                  <li><button type="submit" class="button">Search</button></li>
                </ul>
            </div>
          <div class="top-bar-right">
            <ul class="dropdown menu" data-dropdown-menu>
              <ul class="dropdown menu" data-accordion-menu>
                <li><a href="index.php">Inicio</a></li>
                <li><a>Categorías</a>
                  <ul class="menu vertical nested">
                      <?php
                          for ($i=0; $i < $count_cat ; $i++) { 
                            echo "
                            <li><a href=\"cat.php?cat=".$cat_arr[$i][0]."\">".$cat_arr[$i][1]."</a></li>";                            
                          }
                      ?>
                  </ul>
                </li>
                <li>
                  <a href="#"><?php echo $usuario;?></a>
                  <ul class="menu vertical nested">
                    <li><a href="perfil.php?pan=1">Perfil</a></li>
                    <li><a href="cambiar_clave.php">Cambio de clave</a></li>
                    <li><a href="perfil.php?pan=2">Mis Anuncios</a></li>
                    <li><a href="perfil.php?pan=3">Monedero</a></li>
                  </ul>
                </li>
                <li><a href="#">Mensajes</a></li>
                <li><a href="../controladores/logout_c.php">Cerrar Sesión <i class="fi-x"></i></a></li>
              </ul>
            </ul>
          </div>
        </div>
 </header>
