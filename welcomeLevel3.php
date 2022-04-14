<?php
   include('session.php');
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Welcome </title>
      <link rel="shortcut icon" href="#">   
   </head>
    <body>
    <?php
        $emailSession = $_SESSION['login_user'];
        $query = "SELECT level FROM user WHERE email = '$emailSession' AND level = 3";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result) == 1){  ?>
        <h1>Welcome <?php echo $login_session ?> - Your level is 3    </h1> 
        <div>
        <?php
        include('cake.php');
        ?>
        </div> 
        <div><h2><a href = 'login.php'>Sign Out</a></h2></div>
            <?php
        } else{
        echo "You cannot connect to this page";
        }
    ?>
    </body>
</html>