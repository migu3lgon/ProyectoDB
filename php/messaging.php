<?php
    //connect to the database
    require_once("partials/connect.php");
    session_start();
    //shop not login  users from entering 
    /*if(isset($_SESSION['idusuario'])){
        $user_id = $_SESSION['idusuario'];
    }else{
        header("Location: index.php");
    }*/
?>
<!DOCTYPE html>
<html>
<head>
    <title>Facebook Style Private Messaging System in php</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <center>
        <a href="http://blog.hackerkernel.com/2015/09/17/jqueryui-autocomplete-dropdown-with-php-and-json" target="_blank">Tutorial</a> / 
        <a href="http://demo.hackerkernel.com/download.php?url=1ozuzawpkwuzjd3uzmomwbrt5pnzpjsa" target="_blank">Download Script</a> / 
        <a href="http://hackerkernel.com/contact.php" target="_blank">Want Me to Work on your Dream Project</a> / 
        <br>
        <strong>Welcome <?php echo $_SESSION['username']; ?>  <a href="logout.php">logout</a></strong>
    </center>
     
    <div class="message-body">
        <div class="message-left">
            <ul>
                <?php
                    //show all the users expect me
                    $q = mysqli_query($con, "SELECT * FROM `usuario` WHERE idusuario='.$user_id.'");
                    //display all the results
                    while($row = mysqli_fetch_assoc($q)){
                        echo '<a href="message.php?id="{'.$row["idusuario"].'}"><li> {'.$row["username"].'}</li></a>';
                    }
                ?>
            </ul>
        </div>
 
        <div class="message-right">
            <!-- display message -->
            <div class="display-message">
            <?php
                //check $_GET['id']; is set
                if(isset($_GET['id'])){
                    $user_two = trim(mysqli_real_escape_string($con, $_GET['id']));
                    //check $user_two is valid
                    $q = mysqli_query($con, "SELECT `id` FROM `user` WHERE id='$user_two' AND id!='$user_id'");
                    //valid $user_two
                    if(mysqli_num_rows($q) == 1){
                        //check $user_id and $user_two has conversation or not if no start one
                        $conver = mysqli_query($con, "SELECT * FROM `conversation` WHERE (user_one='$user_id' AND user_two='$user_two') OR (user_one='$user_two' AND user_two='$user_id')");
 
                        //they have a conversation
                        if(mysqli_num_rows($conver) == 1){
                            //fetch the converstaion id
                            $fetch = mysqli_fetch_assoc($conver);
                            $conversation_id = $fetch['id'];;
                        }else{ //they do not have a conversation
                            //start a new converstaion and fetch its id
                            $q = mysqli_query($con, "INSERT INTO `conversation` VALUES ('','$user_id',$user_two)");
                            $conversation_id = mysqli_insert_id($con);
                        }
                    }else{
                        die("Invalid $_GET ID.");
                    }
                }else {
                    die("Click On the Person to start Chating.");
                }
            ?>
            </div>
            <!-- /display message -->
 
            <!-- send message -->
            <div class="send-message">
                <!-- store conversation_id, user_from, user_to so that we can send send this values to post_message_ajax.php -->
                <input type="hidden" id="conversation_id" value="<?php echo base64_encode($conversation_id); ?>">
                <input type="hidden" id="user_form" value="<?php echo base64_encode($user_id); ?>">
                <input type="hidden" id="user_to" value="<?php echo base64_encode($user_two); ?>">
                <div class="form-group">
                    <textarea class="form-control" id="message" placeholder="Enter Your Message"></textarea>
                </div>
                <button class="btn btn-primary" id="reply">Reply</button> 
                <span id="error"></span>
            </div>
            <!-- / send message -->
        </div>
    </div>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script> 
</body>
</html>