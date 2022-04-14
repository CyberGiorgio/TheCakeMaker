<?php
   include("config.php");
   session_start();
   
   try{
         if(isset($_POST['login'])) {
                                  // username and password sent from form 
            if(isset($_POST['g-recaptcha-response'])){
            $captcha=$_POST['g-recaptcha-response'];
            }
            if(!$captcha){
                 $error = "Are you a robot?";
            } else {
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
      }
      }catch(Exception $e){
         echo $e->getMessage();
     }

   ?>