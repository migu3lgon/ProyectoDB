<!--Verificar la sesion-->
<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  include('../php/partials/navbar_logged.php');    
} 
else {
  include('../php/partials/NavigationBar.php');    
}

$now = time();

if (isset($_SESSION['expire'])) {
  if($now > $_SESSION['expire']) {
    session_destroy();
    header('Location: http://localhost/proyectodw/php/index.php');
    exit();
  }
}

?>