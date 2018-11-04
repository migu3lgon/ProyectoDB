<script src='../js/cat.js'></script>

<!--logged navbar-->
<header>
 <!-- Navigation Bar -->
 <div class="top-bar" id="Navigation_Bar">
            <div class="top-bar-left">
                <ul class="menu">
                  <figure>
                        <a href="index.php"><img src="../Imagenes/logo.jpg" class="logo" id="Navigation_Bar_Logo" /></a>
                  </figure>
                  <?php
                  if(isset($_GET['search'])){  
                  
                    $valuee = $_GET['search'];
                    echo '
                    <form action="search.php" method="GET">
                      <div class="input-group">
                        <li><input class="input-group-field" type="text" name="search" value="'.$valuee.'"></li>
                        <div class="input-group-button">
                          <li><button type="submit" class="button">Search</button></li>
                        </div>
                      </div>
                    </form>
                    ';}
                  else {
                    echo '
                    <form action="search.php" method="GET">
                    <div class="input-group">
                      <li><input  class="input-group-field" type="text" name="search" placeholder="Search"></li>
                      <div class="input-group-button">
                        <li><button type="submit" class="button">Search</button></li>
                      </div>
                    </div>
                    </form>';
                  }
                  ?>
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
