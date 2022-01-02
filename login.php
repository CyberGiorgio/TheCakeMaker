<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
                               // username and password sent from form 
      
      $myemail = mysqli_real_escape_string($db,$_POST['email']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']);
                                 //query to collect info required
      $sql = "SELECT * FROM user WHERE email = '$myemail' AND password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $indexLevel = $row["level"];
      $active = $row['active'];
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
        
      if($count == 1) {
         //session_register("myusername");
         $_SESSION['login_user'] = $myemail;
       
        // myStorage = window.sessionStorage;
        // sessionStorage.setItem('login_user', $myemail);
                     //redirected depending on the level
         if($indexLevel == 1){
         header("location: welcomeLevel1.php");
        } else if ($indexLevel == 2){
         header("location: welcomeLevel2.php");
        } else if ($indexLevel == 3){
         header("location: welcomeLevel3.php");
      }
      }else {           //login failed
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<html>
    <head>
        <script>
        function sessionKiller(){       //kill any previous sessions
            sessionStorage.removeItem('email');
            }
        </script> 

      <title>Login Page</title>
       <link rel="shortcut icon" href="#">
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
      </style>
   <script> function sessionStored(){ //get a new session stored
        var input = document.getElementById("email");
        sessionStorage.setItem("email", input.value); 
        }
   </script>
   </head>
   
   <body bgcolor = "#FFFFFF">
   <script>
            sessionKiller();
   </script>
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
            <div style = "margin:30px">
               
               <form action = "login.php" method = "post">
                  <label>Email  :</label><input type = "text" id ="email" name = "email" class = "box" required="" /><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" required="" /><br/><br />
                  <input type = "submit" onclick ="sessionStored();" value = " Submit "/><br />
               </form>
               
            <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
            </div>
         </div>
      </div>
   </body>
</html>