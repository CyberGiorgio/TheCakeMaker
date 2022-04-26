<?php
   include("config.php");
   session_start();
   if(isset($_POST['login'])) {
     if(isset($_POST['g-recaptcha-response'])){ //recaptcha done?
         $captcha=$_POST['g-recaptcha-response'];
         }
      if(!$captcha){       //recaptcha faild
           $error = "Are you a robot?";
      } else {
         $email = mysqli_real_escape_string($db,$_POST['email']);
         $password = mysqli_real_escape_string($db,$_POST['password']);
         $level = mysqli_real_escape_string($db,$_POST['level']);
         $stmt = $db->prepare("SELECT * FROM user WHERE email=? AND password=? LIMIT 1");
         $stmt->bind_param('ss', $email, $password);     //secure prepare statement
         $stmt->execute();
         $stmt->bind_result($email, $password);
         $stmt->store_result();

         if($stmt->num_rows > 0)  //To check if the row exists
            {
               mysqli_stmt_execute($stmt);
               $result = mysqli_stmt_get_result($stmt);
               $row = mysqli_fetch_array($result, MYSQLI_NUM);
               $indexLevel = $row[5];  //index 5 = level of user
               $_SESSION['login_user'] = $email;   //store the session   
               if($indexLevel == 1){      //redirect user
                 header("Location: welcomeLevel1.php");
               } else if ($indexLevel == 2){
                 header("Location: welcomeLevel2.php");
               } else if ($indexLevel == 3){
                 header("Location: welcomeLevel3.php");
            }
         }else {           //login failed
            $error = "  Your Login Name or Password is invalid $indexLevel";
         }
      $stmt->close();
      $db->close();
      }
   }
?>