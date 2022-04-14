<?php
   $id = mysqli_real_escape_string($db,$_POST['id']);                   //variables for user table
   $name = mysqli_real_escape_string($db,$_POST['name']);
   $surname = mysqli_real_escape_string($db,$_POST['surname']);
   $email = mysqli_real_escape_string($db,$_POST['email']);
   $password = mysqli_real_escape_string($db,$_POST['password']);
   $level = mysqli_real_escape_string($db,$_POST['level']);

   if(isset($_POST['addUser'])){                                     //queries for user table
        $sql = "SELECT name,surname FROM `user` WHERE name='$name' AND surname ='$surname'";  
        $result = mysqli_query($db,$sql);
        $row = mysqli_num_rows($result);
        if($row == 0 ) {
            $sql = "INSERT INTO user (name, surname, email, password, level) VALUES ('$name', '$surname', '$email','$password','$level')";
            $result = mysqli_query($db,$sql);
        }else{
            $error = "This record already exists!";
        }
   }
   if(isset($_POST['updateUser'])){
   $sql = "UPDATE user SET name='$name', surname='$surname', email='$email', password='$password', level='$level' WHERE id='$id'";
   $result = mysqli_query($db,$sql);
   }
   if(isset($_POST['removeUser'])){
   $sql = "DELETE FROM `user` WHERE `id`='$id'";
   $result = mysqli_query($db,$sql);
   }
?>
<h3>USER</h3>
<p>Click on the field you wish to modify and press update</p>
<table width="70%" >
  <tr style="text-align:left">
     <th><label>User ID</label></th>
     <th><label>Name</label></th>
     <th><label>Surname</label></th>
     <th><label>Email</label></th>
     <th><label>Password</label></th>
     <th><label>Level</label></th>
  </tr>

  <?php
  $query = "SELECT * FROM user ORDER BY name ASC";
  $result = mysqli_query($db, $query);
   if (mysqli_num_rows($result) > 0) 
      {
      //output data of each row
      while($row = mysqli_fetch_assoc($result)) 
         {
         ?>
          <form method="post" action="welcomeLevel1.php">
            <tr>
               <td><?php echo $row['id']; ?></td>
               <td><input type="text" name="name" value="<?php echo $row['name']; ?>"/>           </td>
               <td><input type="text" name="surname" value="<?php echo $row['surname']; ?>"/>     </td>              
               <td><input type="text" name="email" value="<?php echo $row['email']; ?>">          </td>
               <td><input type="text" name="password" value="<?php echo $row['password']; ?>">    </td>        
               <td>
                  <select name="level" id="level">
                     <option value="<?php echo $row['level']; ?>"><?php echo $row['level']; ?></option>
                     <option value="null">-</option>
                     <option value="1">1</option>
                     <option value="2">2</option>
                     <option value="3">3</option>
                  </select>
               </td>
               <td> 
                  <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
                  <input type="submit" name="updateUser" value="Update User"/>         
               </td>
               <td>
                  <form method="post" action="welcomeLevel1.php">
                     <input type="submit" name="removeUser" value="Remove User"/>
                  </form>
               </td>
            </tr>
         </form>
         <?php
         }
      } else {echo "0 results</br>";}
      ?>
   <form action="welcomeLevel1.php" method="POST">      
     <tr>
        <td></td>
        <td><input name="name" placeholder="Name" required>             </input></td>
        <td><input name="surname" placeholder="Surname" required>      </input></td>
        <td><input name="email" placeholder="Email" required>           </input></td>
        <td><input name="password" placeholder="Password" required>     </input></td>
        <td>
            <select name="level" id="level" required>
               <option value="<?php echo $row['level']; ?>"></option>
               <option value="null">-</option>
               <option value="1">1</option>
               <option value="2">2</option>
               <option value="3">3</option>
            </select>
         </td>
            <input type="hidden" name="addUser" value="users"></input>
        <td><input name="addUser" type="submit" value="Add User"></input></td>
     </tr>
      <tr><td><div id="textError"><?php echo $error; ?></div><td></tr>
   </form>
</table>