<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="../css/foundation.css">
    <link rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" href="../css/css.css">
    <link rel="stylesheet" href="../css/foundation-icons/foundation-icons.css">
    <script src="../js/vendor/jquery.js"></script>
    <?php include('/partials/connect.php') 
    /*$servername = "ns8481.hostgator.com";
    $username = "yosoyman_connect";
    $password = "conn1234!";
    $dbname = "yosoyman_gioscorp";*/
    ?>
    <?php
        

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        $conn2 = new mysqli($servername, $username, $password, $dbname);
        $conn3 = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        if ($conn2->connect_error) {
            die("Connection2 failed: " . $conn2->connect_error);
        }
        if ($conn3->connect_error) {
            die("Connection3 failed: " . $conn3->connect_error);
        }
        
    ?>
</head>
<body>
<?php
    include('../controladores/navbar_c.php');
    include('../controladores/checksession_c.php');
    $id = $_SESSION['id_usuario'];
     
    $prueba = $conn2->query("call datos_perfil(".$id.");");
    $row = $prueba->fetch_assoc(); 
        $correo = $row["correo"];
        $nombre = $row["nombre"];
        $apellido = $row["apellido"];
        $telefono = $row["telefono"];
        $saldo = $row["saldo"];
    $count_a = $conn->query("SELECT count_ad(".$id.") AS count_ad;");
    $row = $count_a->fetch_assoc(); 
        $num_ad = $row['count_ad'];
?>

<?php
    if (isset($_GET['bool'])) {
        if ($_GET['bool']) {
            echo '<script language="javascript"> alert("Monto de agregado con éxito") </script>';
        }
        else {
            echo '<script language="javascript"> alert("Hubo con problema, inténtalo de nuevo") </script>';
        }
    }
    if (isset($_GET['destac'])) {
        if ($_GET['destac']) {
            echo '<script language="javascript"> alert("Anuncio destacado con exito") </script>';
        }
        else {
            echo '<script language="javascript"> alert("Hubo con problema, inténtalo de nuevo") </script>';
        }
    }
    if (isset($_GET['err'])) {
        if ($_GET['err']) {
            echo '<script language="javascript"> alert("no dispones de saldo suficiente para utilizar este servivio") </script>';
        } else {
            echo '<script language="javascript"> alert("porfavor utilize el sitio correctamente") </script>';

        }
    }
    if (isset($_GET['pan'])) {
        $panel = $_GET['pan'];
        if ($panel == 2) {
            $pan1 = '';
            $pan3 = '';
            $pan2 = 'is-active';
        }
        elseif ($panel == 3) {
            $pan1 = '';
            $pan2 = '';
            $pan3 = 'is-active';
        }
        else {
            $pan1 = 'is-active';
            $pan2 = '';
            $pan3 = '';
        }
    }
    else {
        $pan1 = 'is-active';
        $pan2 = '';
        $pan3 = '';
    }
    ?>
    <div class="mainb">
    <div class="grid-container">
            <div class="grid-x grid-margin-x">
                <div class="cell small-12">
                    <ul class="tabs" data-tabs id="example-tabs">
                        <li class="tabs-title <?php echo $pan1 ?>"><a href="#panel1" aria-selected="true">Mi Perfil</a></li>
                        <li class="tabs-title <?php echo $pan2 ?>"><a href="#panel2">Mis Anuncios</a></li>
                        <li class="tabs-title <?php echo $pan3 ?>"><a href="#panel3">Monedero</a></li>
                    </ul>

                <div class="tabs-content" data-tabs-content="example-tabs">
                    <div class="tabs-panel <?php echo $pan1 ?>" id="panel1">
                        <h3>Mi Información</h3>
                        <hr>
                        <p>Usuario: 
                            <span class='descripcion'><?php echo $nombre, " ",  $apellido?></span>
                        </p>
                        <p>Correo: 
                            <span class='descripcion'><?php echo $correo ?></span>
                        </p>
                        <p>Telefono: 
                            <span class='descripcion'><?php if($telefono){echo $telefono;} else {echo "Aun no has ingresado tu telefono";}; ?></span>
                        </p>
                        <p>Clave: 
                            <span class='descripcion'>************ </span><a href="cambiar_clave.php"> Cambio de clave</a>
                        </p>
                        <p><button class="button" data-open="actualizarInformacionModal">Actualizar Informacion</button></p>
                    </div>
                    <div class="tabs-panel <?php echo $pan2 ?>" id="panel2">
                        <div class="grid-container">
                        <h3>Mis Anuncios <span class='float-right'><?php echo $num_ad; ?></span></h3>
                        <hr>
                            <?php  
                                $imagen = $conn->query("call informacion_mis_anuncios(".$id.");");
                                
                                while($row = mysqli_fetch_array($imagen))  
                                {  
                                    if ($row['Imagen'] != NULL) {
                                        $img = '<img class="img_anuncio" src="data:image/jpeg;base64,'.base64_encode($row['Imagen'] ).'"  alt="imagen producto"/>';  
                                    }
                                    else {
                                        $img = '<img class="img_anuncio" src="../Imagenes/Sin_imagen_disponible.jpg"  alt="Sin imagen"/>';
                                    }
                                    if ($row['descripcion']!= NULL) {
                                        $prodDesc = $row['descripcion'];
                                    }
                                    else {
                                        $prodDesc = "Sin descripcion.";
                                    }
                                    $prodName = $row['titulo'];
                                    $prodPrice = $row['precio'];
                                    $prodID = $row['idanuncio'];
                                    echo'<div class="grid-x grid-margin-x align-middle">
                                            <div class="cell small-12 medium-3 large-3">
                                                <h4>'.$prodName.'</h4>
                                                <br>
                                                <h4>Q '.$prodPrice.'</h4>
                                            </div>
                                            <div class="cell small-12 medium-3 large-3">
                                                <p> '.$prodDesc.'</p>
                                            </div>
                                            <div class="cell small-12 medium-3 large-3 anuncio">
                                                '.$img.'
                                            </div>
                                            <div class="cell small-12 medium-3 large-3">
                                                <a href="anuncio.php?id_add='.$prodID.'"><button class="button expanded">Ver</button></a>
                                            <br>
                                                <a href="modificarAnuncio.php?id_add='.$prodID.'" class="button expanded">Modificar</a>
                                            <br>
                                                <a href="destacar.php?id_add='.$prodID.'" class="button expanded">destacar</a>
                                            </div>
                                        </div>
                                        <hr>';
                                }        
                            ?>    
                            <a href='nuevoanuncio.php'><button class='button' type='button'>Nuevo Anuncio</button></a>
                        </div>
                    </div>
                    <div class="tabs-panel <?php echo $pan3 ?>" id="panel3">
                        <h3>Fondos del Monedero</h3>
                        <hr>
                        <div class="fondosMonedero">
                            <p>Q <?php echo $saldo; ?></p>
                        </div>
                        <button class="button" data-open="addFounds">Agregar Fondos al Monedero</button>
                    </div>                     
                </div>
                </div>
            </div>
        </div>

        <div class="reveal" id="actualizarInformacionModal" data-reveal>
            <form action="perfil.php" method="post" enctype="multipart/form-data">
                <h3>Actualización de perfil</h3>
                Nombre:<br>
                <input type="text" name="nombre" value="<?php echo $nombre ?>" placeholder="Ingrese aqui su nombre">
                Apellido:<br>
                <input type="text" name="apellido" value="<?php echo $apellido ?>" placeholder="Ingrese aqui su apellido">
                <br> 
                Correo Electrónico:
                <br>
                <input type="text" name="correoe" value="<?php echo $correo ?>" placeholder="Ingrese aqui su correo electronico">
                <br> 
                Teléfono:
                <br>
                <input type="text" name="telefono" value="<?php echo $telefono?>" placeholder="Ingrese aqui su numero de telefono">
                <br> 
                clave:
                <br>
                <span>************</span> <a href="cambiar_clave.php"> Cambio de clave</a>
                <input class="button small-12 cell" type="submit" name="actualisar_perfil" value="Actualizar Perfil" />
            </form>
            <button class="close-button" data-close aria-label="Close modal" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="reveal" id="addFounds" data-reveal>
            <div class="grid-container">
                <form action="../controladores/acreditar_c.php" class="grid-x" method="post" enctype="multipart/form-data">
                    <div class="small-12 cell">
                        <h3>Agregar Fondos</h3>
                    </div>
                    <div class="small-12 cell">
                        <h4>Cantidad:</h4>
                    </div>
                    <div class="input-group small-12 cell">
                        <span class="input-group-label">Q</span>
                        <input class="input-group-field" type="int" name="monto" value="" placeholder="Ingrese el monto" required pattern="[0-9]+">
                    </div>
                    <div class="small-12 cell">
                        <h4>Información de la tarjeta:</h4>
                    </div>
                    <div class="input-group small-8 cell">
                        <span class="input-group-label">Titular:</span>
                        <input class="input-group-field" type="cvv" name='titular' pattern="[A-Za-z]+" placeholder="Nombre del titular de la tarjeta">
                    </div>
                    <div class="input-group small-4 cell">
                        <span class="input-group-label">cvv:</span>
                        <input class="input-group-field" type="cvv" name='cvv' pattern="[0-9]{3,4}" placeholder="### or ####">
                    </div>
                    <div class="input-group small-12 cell">
                        <span class="input-group-label">Tarjeta:</span>
                        <input class="input-group-field" type="card" name="tarjeta" placeholder="Ingrese el numero de la tarjeta" pattern="[0-9]+">
                    </div>
                    <div class="input-group small-12 cell">
                        <span class="input-group-label">Fecha de Vencimiento:</span>
                        <input class="input-group-field" type="month" name='fecha_vencimiento'>
                    </div>
                    <input class="button small-12 cell success" type="submit" name="credito" value="Aceptar" />
                </form>
            </div>
            <button class="close-button" data-close aria-label="Close modal" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
        /*$prueba = $conn->query("call datos_perfil(".$id.");");
        $row = $prueba->fetch_assoc(); 
                $correo = $row["correo"];
                echo $correo;
                $nombre = $row["nombre"];
                echo $nombre;
                $apellido = $row["apellido"];
                echo $apellido;
                $telefono = $row["telefono"];
                echo $telefono;*/

        if (isset($_POST["actualisar_perfil"])) {
            $correo2 = $_POST["correoe"];
            $nombre2 = $_POST["nombre"];
            $apellido2 = $_POST["apellido"];
            $telefono2 = $_POST["telefono"];
            $cons2 = $conn3->query("CALL modificar_perfil(".$id.",'".$correo2."','".$nombre2."','".$apellido2."',".$telefono2.");");
            if ($cons2){
                echo '<script language="javascript"> alert("Perfil actualizado con exito") </script>';
            }else{
                echo '<script language="javascript"> alert("Hubo con problema, inténtalo de nuevo") </script>';
            }
        }
        ?>

        <!--
        <div class="reveal" id="destacadoModal" data-reveal>
            <form action="../controladores/destacado_c.php" method="post" >
                <h3>Destacar Anuncio</h3>
                <input type="hidden" id="id" name="id" value=<?php //echo $id ?>>
                Fercha para inicio de destacado:
                <input type="date" name="fechainicio" min="2018-10-22" value="2018-10-22">
                Fecha para fin de destacado:
                <input type="date" name="fechafin"  value="2018-11-01">
                Tiempo:
                <span> 10 dias</span>
                <br>
                Monedero:
                <span> Q 20</span>
                <br>
                Costo:
                <span> Q 10</span>
                <input class="button small-12 cell" type="submit" name="submit" value="Destacar" />
            </form>
            <button class="close-button" data-close aria-label="Close modal" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        -->

    </div>

    <?php include('/partials/Footer.php') ?>

    <script src="../js/vendor/what-input.js"></script>
    <script src="../js/vendor/foundation.js"></script>
    <script src="../js/app.js"></script>

</body>
</html>
<?php
    mysqli_close($conn);
    mysqli_close($conn2);
    mysqli_close($conn3);
?>