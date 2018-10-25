<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gio's Company - Cambio de Contraseña</title>
    <link rel="stylesheet" href="../css/foundation.css">
    <link rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" href="../css/css.css">
    <link rel="stylesheet" href="../css/foundation-icons/foundation-icons.css">
    <script src="../js/vendor/jquery.js"></script>
</head>
<body>
    <?php include('../controladores/navbar_c.php') ?>
    <div class="grid-container">
        <?php
        if (isset($_GET['cambio'])) {
            if ($_GET['cambio']) {
                echo "
                <div class=\"callout success\">
                    <h5>El cambio de contraseña ha sido exitoso</h5>
                </div>
                ";
            }
            else {
                echo "
                <div class=\"callout alert\">
                    <h5>Parece que algo ha salido mal</h5>
                    <p>Por favor revisa tu contraseña</p>
                </div>
                ";
            }
        }
        ?>
        <div class="grid-x align-center">
            <div class="cell small-5">
                <form class="log-in-form" action='../controladores/cambiar_pswd_c.php' method='post'>
                    <h4 class="text-center">Cambio de Contraseña</h4>
                    <label>Contaseña:
                        <input name='pswd' id='password' type="text" placeholder="Contaseña" required>
                    </label>
                    <label>Nueva Contaseña:
                        <input name='pswd_n' id='password' type="text" placeholder="Contaseña" required>
                    </label>
                    <!--<input id="show-password" type="checkbox"><label for="show-password">Mostrar contraseña</label>-->
                    <p><input type="submit" class="button expanded" value="Cambiar"></p>
                </form>
            </div>
        </div>
    </div>

    <?php include('/partials/Footer.php') ?>

    <script src="../js/vendor/jquery.js"></script>
    <script src="../js/vendor/what-input.js"></script>
    <script src="../js/vendor/foundation.js"></script>
    <script src="../js/app.js"></script>

</body>
</html>