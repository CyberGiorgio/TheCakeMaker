<?php
   include('session.php');
    $email = mysqli_real_escape_string($db,$_POST['email']);
    $level = mysqli_real_escape_string($db,$_POST['level']);
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
         $query = "SELECT level FROM user WHERE email = '$emailSession' AND level = 1";
         $result = mysqli_query($db, $query);
           if(mysqli_num_rows($result) == 1){
           echo "<h1>Welcome $login_session - Your level is 1</h1>" ;
           echo "<div>";
           include('user.php');
                echo "</div><br/><div>";
           include('ingredient.php');
                echo "</div><br/><div>";
           include('cake.php');
                echo "</div><br/>";
                echo "<h2><a href='login.php'>Sign Out</a></h2>";
        } else {
           echo "You cannot connect to this page";
        };?>
        
   </body>
</html>