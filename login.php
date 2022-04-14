<?php
   include("config.php");
   session_start();
   require_once("loginAccess.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <script src="https://www.google.com/recaptcha/api.js"></script>
        <script src="js/js.js"></script> 
      <title>Login Page</title>
      <link rel="shortcut icon" href="#">
 
   <link rel="stylesheet" href="css/style.css">
   </head>
   
   <body bgcolor = "#FFFFFF" onload="sessionKiller()">
      <div id="boxLogin" align="center">
         <div id="boxBorder">
            <div id="textLogin"><b>Login</b></div>
            <div style = "margin:30px">
               
               <form action = "login.php" method = "post">
                  <label>Email  :</label><input type = "text" id ="email" name = "email" class = "box" required="" /><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" required="" /><br/><br />
                  <input type="hidden" name="token_generate" id="token_generate" required>
                  <div class="g-recaptcha" id="recaptcha" name="recaptcha" data-sitekey="6LcQ1mofAAAAAE9S5KGd_mqzYo3kEvbzRRdo2_kd"></div>
                 
                  <input type="submit" name="login" onclick ="sessionStored();" value="Submit"/><br />
                  <span id="captcha" style="margin-left:100px;color:red" />
               </form>
               <div id="textError"><?php echo $error; ?></div>
         </div>
      </div>
   </body>
</html>