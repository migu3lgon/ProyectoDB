<?php
  $usuario = $_SESSION['username'];
?>
<script>
  $(document).ready(function(){
    $.ajax({
          type:'POST',
          url:'../jsons/cat_json.php',
          dataType: "json",
          success:function(data){
              var $cat = $('#cat');
              $cat.empty();
              for (var i=0; i < data.length ; i++) { 
                $cat.append("<li><a href=\"cat.php?cat=" + data[i][0] + "\">" + data[i][1] + "</a></li>");
              }
          }
      });
  });
</script>

<!--logged navbar-->
<header>
 <!-- Navigation Bar -->
 <div class="top-bar" id="Navigation_Bar">
            <div class="top-bar-left">
                <ul class="menu">
                  <figure>
                        <a href="index.php"><img src="../Imagenes/logo.jpg" class="logo" id="Navigation_Bar_Logo" /></a>
                  </figure>
                  <form action="search.php" method="GET">
                  <li><input type="text" name="search" placeholder="Search"></li>
                  <li><button type="submit" class="button">Search</button></li>
                  </form>
                </ul>
            </div>
          <div class="top-bar-right">
            <ul class="dropdown menu" data-dropdown-menu>
              <ul class="dropdown menu" data-accordion-menu>
                <li><a href="index.php">Inicio</a></li>
                <li><a>Categorías</a>
                  <ul id='cat' class="menu vertical nested">
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
