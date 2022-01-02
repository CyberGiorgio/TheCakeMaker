<?php
   include('session.php');
   $ingredientName = mysqli_real_escape_string($db,$_POST['ingredientName']);
   $type = mysqli_real_escape_string($db,$_POST['type']);
   $cakeName = mysqli_real_escape_string($db,$_POST['cakeName']);

      if(isset($_POST['submit'])){                                     //queries for ingredient table
   $sql = "INSERT INTO ingredients (`ingredientId`, `ingredientName`, `amountLeft`, `size`, `type`)VALUES (NULL, '$ingredientName', '0', '0', '$type')";
   $result = mysqli_query($db,$sql);
   $sql = "INSERT INTO cakesmade (`cakeId`, `cakeName`, `quantity`)VALUES (NULL, '$cakeName', '0')";
   $result = mysqli_query($db,$sql);
   }
?>

<!DOCTYPE html>
   <head>
      <title>Welcome </title>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
      <script>
//variable
         var html='<p/><div>Name Ingredient: <input type="text" name="nameIng" id="childName" required/> Type Ingredient: <select name="type" id="type" required><option value="<?php echo $row['type']; ?>"></option> <option value="null">-</option><option value="Dry">Dry</option><option value="Wet">Wet</option></select> <a href="#" id="remove"> Remove </a></div>'
//add rows
         $(document).ready(function(e){
            $("#add").click(function(e){
               $("#container").append(html);
            });
//remove rows
         $("#container").on('click','#remove',function(e){
            $(this).parent('div').remove();
           });
         });
      </script>
   </head>
   <body>
         <h1>Welcome <?php echo $login_session;
       ?> - Your level is 3    </h1> 
    </head>
        <p>
          Click on the button to create your cake
        </p>
        <form method="POST" action="welcomeLevel3.php">
            <div id="container">
               Name Cake: <input type="text" name="cakeName" id="cakeName" required> <br>
               Name Ingredient: <input type="text" name="ingredientName" id="ingredientName" required>
               Type Ingredient: <select name="type" id="type" required>
                                    <option value="<?php echo $row['type']; ?>"></option>
                                    <option value="null">-</option>
                                    <option value="Dry">Dry</option>
                                    <option value="Wet">Wet</option>
                                </select>
               <a href="#" id="add"> Add More </a>
            </div>
         <p/>
            <input type="submit" name="submit"/>
        </form>
    </body>
</html>