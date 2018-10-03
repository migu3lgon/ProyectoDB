<?php
    $usuario = "root";
    $contrasena = "";
    $servidor = "localhost";
    $basededatos = "gioscorp2";

    $conexion = mysqli_connect($servidor,$usuario,$contrasena) or die("No se ha podido conectar al servidor de base de datos.");
    $db = mysqli_select_db($conexion, $basededatos) or die("Parece que ha habido un error.");
?>
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
            else{
                header("Location: http://localhost/proyectodw/php/login.php?login=0");
                exit();
            }
        }
    }
    

?>