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
        $(document).ready(function(){
            $.ajax({
                type:'POST',
                url:'../jsons/subcat_json.php',
                dataType: "json",
                success:function(data){
                    var $subc2 = $('#sub-cat');
                    $subc2.empty();
                    for (var e = 0; e < data['subcat'].length; e++) {
                        if (<?php echo $_GET['cat'];?> == data['subcat'][e][1]) {
                            $subc2.append('<div class="cell">' + 
                            '<a href="view_p.php?subcat=' + data['subcat'][e][0] + '">' +
                                '<div class="card">' +
                                    '<img src="https://placehold.it/180x180">' +
                                    '<div class="card-section">' +
                                    '<h4>' + data['subcat'][e][2] + '</h4>' +
                                    '<p>Description</p>' +
                                    '</div>' +
                                '</div>' +
                            '</a>' +
                            '</div>'); 
                        } 
                    }  
                }
            });
        });
    </script>
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

    <script src="../js/vendor/jquery.js"></script>
    <script src="../js/vendor/what-input.js"></script>
    <script src="../js/vendor/foundation.js"></script>
    <script src="../js/app.js"></script>

</body>
</html>