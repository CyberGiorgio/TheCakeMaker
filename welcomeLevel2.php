<?php
   include('session.php');
    $email = mysqli_real_escape_string($db,$_POST['email']);
    $level = mysqli_real_escape_string($db,$_POST['level']);
?>
<!DOCTYPE html>
   <head>
      <title>Welcome </title>
       <link rel="shortcut icon" href="#">
   </head>
<body>
    <?php 
         $emailSession = $_SESSION['login_user'];
         $query = "SELECT level FROM user WHERE email = '$emailSession' AND level = 2";
         $result = mysqli_query($db, $query);
           if(mysqli_num_rows($result) == 1){
           echo "<h1>Welcome echo $login_session</h1";
           echo "<h1>Your level is 2</h1>"; 
           include('ingredient.php');
           echo "<h2><a href = 'login.php'>Sign Out</a></h2>";
           } else {
           echo "You cannot connect to this page";
        };?>
   </body>
</html>