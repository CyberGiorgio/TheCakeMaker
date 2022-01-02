<?php
   $idIng = mysqli_real_escape_string($db,$_POST['idIng']);        // variables for ingredient table
   $nameIng = mysqli_real_escape_string($db,$_POST['nameIng']);
   $amountLeft = mysqli_real_escape_string($db,$_POST['amountLeft']);
   $size = mysqli_real_escape_string($db,$_POST['size']);
   $type = mysqli_real_escape_string($db,$_POST['type']);

   if(isset($_POST['addIng'])){                                     //queries for ingredient table
   $sql = "INSERT INTO ingredient (nameIng, amountLeft, size, type) VALUES ('$nameIng','$amountLeft','$size','$type')";
   $result = mysqli_query($db,$sql);
   }
   if(isset($_POST['updateIng'])){
   $sql = "UPDATE ingredient SET nameIng='$nameIng', amountLeft='$amountLeft', size='$size', type='$type' WHERE idIng='$idIng'";
   $result = mysqli_query($db,$sql);
   }
   if(isset($_POST['removeIng'])){
   $sql = "DELETE FROM ingredient WHERE idIng='$idIng'" ;
   $result = mysqli_query($db,$sql);
   }
?>
<h3>INGREDIENTS</h3>
<p>Click on the field you wish to modify and press update</p>

<table width="70%">
   <tr>
     <th><label>Ingredient ID</label>          </th>
     <th><label>Ingredient Name</label>        </th>
     <th><label>Amount left in Kg</label>            </th>
     <th><label>Weightof each pack in Kg</label> </th>
     <th><label>Type</label>                   </th>
  </tr>
   <?php
  $query = "SELECT * FROM ingredient ORDER BY nameIng ASC";
  $result = mysqli_query($db, $query);
   if (mysqli_num_rows($result) > 0) 
      {
      while($row = mysqli_fetch_assoc($result)) 
      {
      ?>
      <form action="welcomeLevel1.php" method="POST">
         <tr>
            <td><?php echo $row['idIng']; ?>                                                      </td>
            <td><input type="text" name="nameIng" value="<?php echo $row['nameIng']; ?>">         </td>
            <td><input type="number" min="0" step="0.01" name="amountLeft" value="<?php echo $row['amountLeft']; ?>">   </td>
            <td><input type="number" min="0" step="0.01" name="size" value="<?php echo $row['size']; ?>">               </td>
            <td>
               <select name="type">
                  <option value="<?php echo $row['type']; ?>"><?php echo $row['type']; ?></option>
                  <option value="null">-</option>
                  <option value="Dry">Dry</option>
                  <option value="Wet">Wet</option>
               </select>
            </td>
            <td>
               <input type="hidden" name="idIng" value="<?php echo $row['idIng']; ?>"/>
               <input name="removeIng" type="submit" value="Remove Ingredient"></input>
            </td>
            <td>
               <form action="welcomeLevel1.php" method="POST">
                 <input name="updateIng" type="submit" value="Update Ingredient"></input>
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
        <td><input name="nameIng" placeholder="Name Ingredient" required>                                  </input></td>
        <td><input name="amountLeft" type="number" min="0" placeholder="Amount Left" required>             </input></td>
        <td><input name="size" type="number" min="0" placeholder="Size" required>                          </input></td>
        <td>
            <select name="type" id="type" required>
               <option value="<?php echo $row['type']; ?>"></option>
               <option value="null">-</option>
               <option value="Dry">Dry</option>
               <option value="Wet">Wet</option>
            </select>
         </td>
         <td>
            <input type="hidden" name="addIng" value="Ingredient"></input>
            <input name="addIng" type="submit" value="Add Ingredient"></input>
        </td>
     </tr>
   </form>
</table>