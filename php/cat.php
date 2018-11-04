<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gio's Company - Categorías</title>
    <link rel="stylesheet" href="../css/foundation.css">
    <link rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" href="../css/css.css">
    <link rel="stylesheet" href="../css/foundation-icons/foundation-icons.css">
    <script src="../js/vendor/jquery.js"></script>
    <script>
        var globalVariable={
        cat: <?php echo $_GET['cat'];?>
        };
    </script>
    <script src='../js/subcat.js'></script>
</head>
<body>
    <?php include('../controladores/navbar_c.php'); ?>
    <div class="mainb" align="center">
        <div class="grid-container"> 
        <!---->
        <div id='sub-cat' class="grid-x grid-padding-x small-up-2 medium-up-3">
        </div>
        </div>  
        <!---->
        </div>
    </div>

    <?php include('/partials/Footer.php') ?>

    <script src="../js/vendor/what-input.js"></script>
    <script src="../js/vendor/foundation.js"></script>
    <script src="../js/app.js"></script>

</body>
</html>