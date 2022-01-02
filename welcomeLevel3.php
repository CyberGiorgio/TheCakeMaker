<?php
   include('session.php');
   $email = mysqli_real_escape_string($db,$_POST['email']);
   $level = mysqli_real_escape_string($db,$_POST['level']);
   $cakeId = mysqli_real_escape_string($db,$_POST['cakeId']);                   //variables for user table
   $cakeName = mysqli_real_escape_string($db,$_POST['cakeName']);
   $quantity = mysqli_real_escape_string($db,$_POST['quantity']);

   if(isset($_POST['addCake'])){                                     //queries for user table
   header("location: addCake.php");
   }
   if(isset($_POST['updateCake'])){
   $sql = "UPDATE `cakesmade` SET cakeName='$cakeName', quantity='$quantity' WHERE cakeId='$cakeId'";
   $result = mysqli_query($db,$sql);
   }
   if(isset($_POST['removeCake'])){
   $sql = "DELETE FROM `cakesmade` WHERE `cakeId`='$cakeId'";
   $result = mysqli_query($db,$sql);
   }
?>
<!DOCTYPE html>
   
   <head>
      <title>Welcome </title>
   </head>
   <body>
   <?php
         $emailSession = $_SESSION['login_user'];
         $query = "SELECT level FROM user WHERE email = '$emailSession' AND level = 3";
         $result = mysqli_query($db, $query);
           if(mysqli_num_rows($result) == 1){
         echo "<h1>Welcome echo $login_session - Your level is 3    </h1>"; 
         echo "<h3>CAKES</h3>";
         echo "<p>Click on the field you wish to modify and press update</p>";
         echo"<table width='90%' >";
           echo"<tr>";
              echo"<th><label>ID Cake</label></th>";
              echo"<th><label>Name Cake</label></th>";
              echo"<th><label>Quantity</label></th>";
           echo"</tr>";

           $query = "SELECT * FROM cakesMade ORDER BY cakeName ASC";
           $result = mysqli_query($db, $query);
            if (mysqli_num_rows($result) > 0) 
               {
               //output data of each row
               while($row = mysqli_fetch_assoc($result)) 
                  {
                  ?>
                   <form method="post" action="welcomeLevel3.php">
                     <tr>
                        <td><?php echo $row['cakeId']; ?></td>
                        <td><input type="text" name="cakeName" value="<?php echo $row['cakeName']; ?>"/>           </td>
                        <td><input type="number" min="0" name="quantity" value="<?php echo $row['quantity']; ?>"/>     </td>              
                        <td> 
                           <input type="hidden" name="cakeId" value="<?php echo $row['cakeId']; ?>"/>
                           <input type="submit" name="updateCake" value="Update Quantity"/>         
                        </td>
                        <td>
                           <form method="post" action="welcomeLevel3.php">
                              <input type="submit" name="removeCake" value="Remove Cake"/>
                           </form>
                        </td>
                     </tr>
                  </form>
                  <?php
                  }
               } else {
                   echo "0 results</br>";
               }
               
            echo"<form action='welcomeLevel3.php' method='POST'>";    
              echo"<tr>";
                 echo"<td></td>";
                     echo"<input type='hidden' name='addCake'></input>";
                 echo"<td><input name='addCake' type='submit' value='Add Cake'></input></td>";
              echo"</tr>";
            echo"</form>";
         echo"</table>";

        echo"<h2><a href = 'login.php'>Sign Out</a></h2>";
        } else{
        echo "You cannot connect to this page";
    }
    ?>
   </body>
   
</html>