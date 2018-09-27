<?php
    $usuario = "root";
    $contrasena = "";
    $servidor = "localhost";
    $basededatos = "gioscorp2";

    $conexion = mysqli_connect($servidor,$usuario,$contrasena) or die("No se ha podido conectar al servidor de base de datos.");
    $db = mysqli_select_db($conexion, $basededatos) or die("Parece que ha habido un error.");
    if (isset($_POST['login'])) {
        $log = $_POST['login'];
    }
    else{
        $log = true;
    }
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gio's Company Home</title>
    <link rel="stylesheet" href="../css/foundation.css">
    <link rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" href="../css/css.css">
    <style>
    </style>
</head>
<body>
    <?php include('/partials/NavigationBar.php') ?>
    <div class="grid-container">
        <div class="grid-x align-center">
            <div class="cell small-5">
                <?php
                    if ((isset($_POST['email'])==true)&&((isset($_POST['pswd'])==true))) {
                        $clave = $_POST['pswd'];
                        $email = $_POST['email'];
                        $con = "CALL login('".$email."','".$clave."')";
                        $res = mysqli_query($conexion, $con) or die("Parece que algo ha salido mal!");
                        while ($col = mysqli_fetch_array( $res ))
                        {
                            //logica de login
                            ($col[0]=='success') ? $log = true : $log = false ;
                            if ($log) {
                                //Si el login fue exitoso redirect
                                header("Location: http://localhost/proyectodw/php/index_logged.php"); /* Redirect browser */
                                exit();
                            }
                            echo "<input type=\"text\" style='display: none' name=\"login\" value='".$log."'>";
                        }
                    }
                    if (/*((isset($_POST['sbmt'])==false)||((isset($_POST['login'])==false)))||*/true) {
                        //accion en caso que login sea exitoso o no
                        ($log) ? $small = 'none' : $small = '' ;
                        ($log) ? $br = '' : $br = '<br>' ;
                        echo "<form class=\"log-in-form\" action='Login.php' method='post'>
                            <h4 class=\"text-center\">Inicia sesión</h4>
                            <label>E-mail
                                <input type=\"email\" placeholder=\"somebody@example.com\" name='email'>
                            </label>
                            <label>Contaseña
                                <input type=\"password\" placeholder=\"Contaseña\" name='pswd'>
                            </label>
                            <small class=\"advice\" style=\"display: ".$small."\">Por favor, verifica los datos ingresados</small>".$br."
                            <input id=\"show-password\" type=\"checkbox\"><label for=\"show-password\">Mostrar contraseña</label>
                            <p><input type=\"submit\" class=\"button expanded\" value=\"Submit\"></p>
                            <p class=\"text-center\"><a href=\"#\">¿Olvidaste tu constraseña?</a></p>
                            
                            <input type=\"text\" style='display: none' name=\"sbmt\" value='true'>
                            </form>
                            <p>Si todavía no tienes una cuenta haz click <a href=\"Register.php\">aquí</a></p>";
                    }

                ?>
                
            </div>
        </div>
    </div>

    <?php include('/partials/Footer.php') ?>

    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>

</body>
</html>