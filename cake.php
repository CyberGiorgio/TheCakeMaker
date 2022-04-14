<?php
   $cakeId = mysqli_real_escape_string($db,$_POST['cakeId']);                   //variables for user table
   $cakeName = mysqli_real_escape_string($db,$_POST['cakeName']);
   $quantity = mysqli_real_escape_string($db,$_POST['quantity']);

  /* if(isset($_POST['addCake'])){                                     //queries for user table
        $sql = "INSERT INTO `cakesMade` (`cakeName`, `quantity`) VALUES ('$cakeName', '$quantity')";
        $result = mysqli_query($db,$sql);                                  //queries for ingredient table
   }*/
     if(isset($_POST['addCake'])){
    header("location: addCake.php");
   }
   
   if(isset($_POST['updateCake'])){
   $sql = "UPDATE `cakesMade` SET cakeName='$cakeName', quantity='$quantity' WHERE cakeId='$cakeId'";
   $result = mysqli_query($db,$sql);
   }
   if(isset($_POST['removeCake'])){
   $sql = "DELETE FROM `cakesMade` WHERE `cakeId`='$cakeId'";
   $result = mysqli_query($db,$sql);
   }
?>
 <h3>CAKES</h3>
    <p>Click on the field you wish to modify and press update</p>
    <table width='70%' >
        <tr style="text-align:left">
            <th><label>Cake ID</label></th>
            <th><label>Name Cake</label></th>
            <th><label>Quantity</label></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
   <?php
   $query = "SELECT * FROM cakesMade ORDER BY cakeName ASC";
   $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) > 0) 
       {
       //output data of each row
       while($row = mysqli_fetch_assoc($result)) 
          {
          ?>
           <form method="post">
                <tr>
                    <td><?php echo $row['cakeId']; ?></td>
                    <td><input type="text" name="cakeName" value="<?php echo $row['cakeName']; ?>"/>           </td>
                    <td><input type="number" min="0" name="quantity" value="<?php echo $row['quantity']; ?>"/>     </td>              
                    <td> 
                        <input type="hidden" name="cakeId" value="<?php echo $row['cakeId']; ?>"/>
                        <input type="submit" name="updateCake" value="Update Cake"/>         
                    </td>
                    <td>
                    <form method="post" ">
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
    ?>
</table>
<tr>
    <form method="get" action="addCake.php">
        <button type="submit">Add New Cake</button>
    </form>
</tr>

