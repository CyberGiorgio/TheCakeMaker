<?php
   $idIng = mysqli_real_escape_string($db,$_POST['idIng']);        // variables for ingredient table
   $nameIng = mysqli_real_escape_string($db,$_POST['nameIng']);
   $amountLeft = mysqli_real_escape_string($db,$_POST['amountLeft']);
   $size = mysqli_real_escape_string($db,$_POST['size']);
   $type = mysqli_real_escape_string($db,$_POST['type']);

   if(isset($_POST['addIng'])){                                     //queries for ingredient table
        $sql = "SELECT nameIng,type FROM `ingredients` WHERE nameIng='$nameIng' AND type ='$type'";  
        $result = mysqli_query($db,$sql);
        $row = mysqli_num_rows($result);
        if($row == 0 ) {
            $sql = "INSERT INTO `ingredients` (`nameIng`, `amountLeft`, `size`, `type`) VALUES ('$nameIng','$amountLeft','$size','$type')";
            $result = mysqli_query($db,$sql);
        }else{
            $error = "This record already exists!";
        }
   }
   if(isset($_POST['updateIng'])){
   $sql = "UPDATE ingredients SET nameIng='$nameIng', amountLeft='$amountLeft', size='$size', type='$type' WHERE idIng='$idIng'";
   $result = mysqli_query($db,$sql);
   }
   if(isset($_POST['removeIng'])){
   $sql = "DELETE FROM ingredients WHERE idIng='$idIng'" ;
   $result = mysqli_query($db,$sql);
   }
?>
<h3>INGREDIENTS</h3>
<p>Click on the field you wish to modify and press update</p>

<table width="70%">
   <tr style="text-align:left">
     <th><label>Ingredient ID</label>          </th>
     <th><label>Ingredient Name</label>        </th>
     <th><label>Amount left in Kg</label>            </th>
     <th><label>Weightof each pack in Kg</label> </th>
     <th><label>Type</label>                   </th>
     <th>          </th>
     <th>          </th>
  </tr>
   <?php
  $query = "SELECT * FROM ingredients ORDER BY nameIng ASC";
  $result = mysqli_query($db, $query);
   if (mysqli_num_rows($result) > 0) 
      {
      while($row = mysqli_fetch_assoc($result)) 
      {
      ?>
      <form method="POST">
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
               <input name="updateIng" type="submit" value="Update Ingredient"></input>
            </td>
            <td>
               <form method="POST">
                 <input name="removeIng" type="submit" value="Remove Ingredient"></input>
              </form>
            </td>
         </tr>
      </form>
      <?php
         }
      } else {echo "0 results</br>";}
    ?>
  <form method="POST">      
     <tr>
        <td></td>
        <td><input name="nameIng" type="text" placeholder="Name Ingredient" required>                                  </input></td>
        <td><input name="amountLeft" type="number"  min="0" step="0.01" placeholder="Amount Left" required>                         </input></td>
        <td><input name="size" type="number" min="0" step="0.01" placeholder="Size" required>                                      </input></td>
        <td>
            <select name="type" required>
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
     <tr><td><div id="textError"><?php echo $error; ?></div><td></tr>
   </form>
   
</table>