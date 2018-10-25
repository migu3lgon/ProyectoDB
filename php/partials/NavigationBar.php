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
                  <li><input type="search" placeholder="Search"></li>
                  <li><button type="submit" class="button">Search</button></li>
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
                <li><a href="login.php">Inicia Sesión</a></li>
                <li><a href="register.php">Regístrate</a></li>
              </ul>
            </ul>
          </div>
        </div>
 </header>
