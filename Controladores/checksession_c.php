<!-- Verificar sesion -->
<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    
} 
else {
    header('Location: http://localhost/proyectodb/php/index.php');
}

$now = time();

if (isset($_SESSION['expire'])) {
  if($now > $_SESSION['expire']) {
    session_destroy();
    header('Location: http://localhost/proyectodb/php/index.php');
    exit();
  }
}

?>