<?php
    if (isset($_GET['login'])) {
        $log = $_GET['login'];
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
    <title>Gio's Company - Login</title>
    <link rel="stylesheet" href="../css/foundation.css">
    <link rel="stylesheet" href="../css/app.css">
    <link type="text/css" rel="stylesheet" href="../css/css.css">
    <style>
    </style>
</head>
<body>
    <?php include('../controladores/navbar_c.php') ?>
    <?php 
        //accion en caso que login sea exitoso o no
        
        if ($log) {
            $small = 'none';
            $br = '';
            $err = '';
        }
        else{
            $small = '' ;
            $br = '<br>' ;
            $err = "error";
        }

    ?>
    <div class="grid-container">
        <div class="grid-x align-center">
            <div class="cell small-5">
                <form class="log-in-form" action='../controladores/login_c.php' method='post'>
                            <h4 class="text-center">Inicia sesión</h4>
                            <label class='<?php echo $err;?>' >E-mail
                                <input type="email" placeholder="somebody@example.com" name='email' required>
                            </label>
                            <label class='<?php echo $err;?>'>Contaseña
                                <input type="password" placeholder="Contaseña" name='pswd' required>
                            </label>
                                <small class="advice <?php echo $err;?>" style="display: <?php echo $small;?>">Por favor, verifica los datos ingresados</small><?php echo $br; ?>
                            <input id="show-password" type="checkbox"><label for="show-password">Mostrar contraseña</label>
                                <p><input type="submit" class="button expanded" value="Submit"></p>
                            <p class="text-center"><a href="#">¿Olvidaste tu constraseña?</a></p>
                            
                            <input type="text" style='display: none' name="sbmt" value='true'>
                            </form>
                            <p>Si todavía no tienes una cuenta haz click <a href="Register.php">aquí</a></p>
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
