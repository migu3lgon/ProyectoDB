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
    <?php include('NavigationBar.php') ?>
    <div class="grid-container">
        <div class="grid-x align-center">
            <div class="cell small-5"
                <form class="log-in-form">
                    <h4 class="text-center">Regístrate</h4>
                    <label>E-mail
                        <input type="email" placeholder="somebody@example.com">
                    </label>
                    <label>Contaseña
                        <input type="password" placeholder="Contaseña">
                    </label>
                    <input id="show-password" type="checkbox"><label for="show-password">Mostrar contraseña</label>
                    <p><input type="submit" class="button expanded" value="Log in"></input></p>
                    <p class="text-center"><a href="#">¿Olvidaste tu constraseña?</a></p>
                </form>
                <p>Si ya tienes una cuenta haz click <a href="Login.php">aquí</a></p>
            </div>
        </div>
    </div>

    <?php include('Footer.php') ?>

    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>

</body>
</html>