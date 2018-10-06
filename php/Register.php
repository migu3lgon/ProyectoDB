<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gio's Company - Regístrate</title>
    <link rel="stylesheet" href="../css/foundation.css">
    <link rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" href="../css/css.css">
    <style>
    </style>
</head>
<body>
    <?php include('../controladores/navbar_c.php') ?>
    <div class="grid-container">
        <div class="grid-x align-center">
            <div class="cell small-5">
                <form class="log-in-form" action='../controladores/register_c.php' method='post'>
                    <h4 class="text-center">Regístrate</h4>
                    <label>Nombre:
                        <input name='name' type="text" placeholder="Nombre" required>
                    </label>
                    <label>Apellido:
                        <input name='last-n' type="text" placeholder="Apellido" required>
                    </label>
                    <label>E-mail:
                        <input name='email' type="email" placeholder="somebody@example.com" required>
                    </label>
                    <label>Número de télefono:
                        <input name='fnum' type="tel" placeholder="01010101" required>
                    </label>
                    <label>Contaseña:
                        <input name='pswd' type="text" placeholder="Contaseña" required>
                    </label>
                    <!--<input id="show-password" type="checkbox"><label for="show-password">Mostrar contraseña</label>-->
                    <p><input type="submit" class="button expanded" value="Log in"></p>
                </form>
                <p>Si ya tienes una cuenta haz click <a href="Login.php">aquí</a></p>
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