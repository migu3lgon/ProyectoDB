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
                  <form action="search.php" method="POST">
                  <li><input type="search" name="search" placeholder="Search"></li>
                  <li><button type="submit" class="button">Search</button></li>
                  </form>
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
                <li><a href="login.php">Inicia Sesión</a></li>
                <li><a href="register.php">Regístrate</a></li>
              </ul>
            </ul>
          </div>
        </div>
 </header>

<!--scripts para el accordion menu-->
<script src="../js/vendor/vendor.js"></script>
<script src="../js/vendor/foundation.core.js"></script>
<script src="../js/vendor/foundation.util.nest.js"></script>
<script src="../js/vendor/foundation.accordion.js"></script>
<script src="../js/vendor/foundation.accordionMenu.js"></script>
<script src="../js/vendor/foundation.responsiveAccordionTabs.js"></script>
<script src="../js/vendor/docs.js"></script>