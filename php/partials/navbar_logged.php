<?php
    $usuario = $_SESSION['name'];
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
                  <li><button type="button" class="button">Search</button></li>
                </ul>
            </div>
          <div class="top-bar-right">
            <ul class="dropdown menu" data-dropdown-menu>

              <ul class="horizontal menu" data-accordion-menu>
                <li><a href="index.php">Inicio</a></li>
                <li>
                  <a href="#"><?php echo $usuario;?></a>
                  <ul class="menu vertical nested">
                  <li><a href="#">Perfil</a></li>  
                  <li><a href="#">Mis Anuncios</a></li>
                  </ul>
                </li>
                <li><a href="../controladores/logout_c.php">Cierra Sesión</a></li>
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