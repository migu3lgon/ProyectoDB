<?php  ?>
<?php include('../controladores/navbar_c.php'); ?>
<?php if (isset($_GET['id_add'])) {
            $idanuncio = $_GET['id_add'];
        }
        else {
            echo '<script language="javascript"> alert("Tienes que elegir un anuncio!") </script>';
            header('Location: http://localhost/proyectodb/php/index.php');
            exit();
        }
        $usuario = $_SESSION['id_usuario'];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "gioscorp2";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        //query para obtener la imagen del anuncio
        $query = $conn->query("SELECT precio from anuncio where idanuncio=$idanuncio limit 1;"); 
        $row = $query->fetch_assoc(); 
                $precioa = $row["precio"];
        $fecha = date('Y-m-d H:i:s');

        $insert = $conn->query("INSERT into ventas (idusuario, idanuncio, monto, fecha) 
                        VALUES ($usuario, $idanuncio, $precioa,'$fecha')");
                    if($insert){
                        echo "si funcia";
                    }else{
                        echo "no funcia";
                    }
                    header('Location: http://localhost/proyectodb/php/perfil.php');
        
?>
