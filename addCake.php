<?php
    include('session.php');
    $email = mysqli_real_escape_string($db,$_POST['email']);
    $level = mysqli_real_escape_string($db,$_POST['level']);
    $cakeName = mysqli_real_escape_string($db,$_POST['cakeName']);
    $nameIng = mysqli_real_escape_string($db,$_POST['nameIng']);
    $emailSession = $_SESSION['login_user'];
    $query = "SELECT `level` FROM user WHERE email = '$emailSession'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $indexLevel = $row["level"];
    if(isset($_POST['submit_row']))
    {
        $nameIng=$_POST['nameIng'];
        $type=$_POST['type'];
        for($i=0;$i<count($nameIng);$i++)
        {
            if($nameIng[$i]!="" && $type[$i]!="")
            {
                $sql = "SELECT nameIng,type FROM `ingredients` WHERE nameIng='$nameIng[$i]' AND type='$type[$i]'";  
                $result = mysqli_query($db,$sql);
                $row = mysqli_num_rows($result);
                if($row == 0 ) {
                    $sql = "INSERT INTO `ingredients` (`nameIng`, `type`) VALUES ('$nameIng[$i]','$type[$i]')";  
                    $result = mysqli_query($db,$sql);
                    
                }else{
                  $error = "The record '$nameIng[$i]' type '$type[$i]' already exists!";
                }
               
            }
        }
        $sql = "SELECT cakeName FROM `cakesMade` WHERE cakeName='$cakeName'";  
        $result = mysqli_query($db,$sql);
        $row = mysqli_num_rows($result);
        if($row == 0 ) {
            $sql = "INSERT INTO `cakesMade` (`cakeId`, `cakeName`, `quantity`) VALUES (NULL, '$cakeName', '0')";
            $result = mysqli_query($db,$sql);
        }else{
            $error = "The $cakeName cake already exists!";
        }
        if($indexLevel == '1'){
       header('location: welcomeLevel1.php'); 
        }
        if($indexLevel == '2'){
        header('location: welcomeLevel2.php'); 
        }
        if ($indexLevel == '3'){
        header('location: welcomeLevel3.php'); 
        }
    }
    if(isset($_POST['back'])){
        if($indexLevel == '1'){
        header('location: welcomeLevel1.php'); 
        }
        if($indexLevel == '2'){
        header('location: welcomeLevel2.php'); 
        }
        if ($indexLevel == '3'){
        header('location: welcomeLevel3.php'); 
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
   <head>
       <link rel="shortcut icon" href="#">   
        <title>Welcome </title>
        <script src="js/js.js"></script> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
        <script type="text/javascript" src="jquery.js"></script>
        <script>function add_row()
        {
                $rowno=$("#cakeTable tr").length;
                $rowno=$rowno+1;
                $("#cakeTable tr:last").after("<tr id='row"+$rowno+"'> <td>Name Ingredient: <input type='text' name='nameIng[]'  required></td><td>Type Ingredient:<select name='type[]' required> <option value='echo $row['type']'></option><option value='null'>-</option><option value='Dry'>Dry</option><option value='Wet'>Wet</option></select></td></td><td><input type='button' value='DELETE' onclick=delete_row('row"+$rowno+"')></td></tr>");
        }
        function delete_row(rowno)
        {
                $('#'+rowno).remove();
        }
</script>
   <link rel="stylesheet" href="css/style.css">
   </head>
   <body>
        <h1>Welcome <?php echo $login_session;?> - Your level is <?php echo  $indexLevel ?></h1> 
        <p>Click on the button to create your cake</p>
        <div id="wrapper">
            <div id="form_div">
                 <form method="post" >
                      <table id="cakeTable" align=center>
                           <tr id="row1">
                                <td> Name Cake: <input type="text" name="cakeName" required> </td>
                            </tr>
                            <tr>
                                <td>Name Ingredient: <input type="text" name="nameIng[]" required></td>
                                <td>Type Ingredient: 
                                    <select name="type[]" id="type" required>
                                        <option value="<?php echo $row['type']; ?>"></option>
                                        <option value="null">-</option>
                                        <option value="Dry">Dry</option>
                                        <option value="Wet">Wet</option>
                                    </select> 
                                </td>
                                <td>
                               <input type="button" onclick="add_row();" value="Add Ingredient">
                               <input type="submit" name="submit_row" value="Submit Cake">
                               </td>
                            </tr>
                      </table>
                      <tr><td><div id="textError"><?php echo $error; ?></div><td></tr>
                 </form>
            </div>
        </div>
        <div>
            <form method="post" >
                <button name="back" type="submit">Back</button>
            </form>
        </div>
    </body>
</html>