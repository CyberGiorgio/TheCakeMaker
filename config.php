<?php   
	$dbhost = "sql300.epizy.com"; //server name localhost or 127.0.0.1
	$dbuser = "epiz_29965794";      //User name default root 
	$dbpass = "n0Qn6DAxBjepq";  //Password reset at start of uniserver yours is "root"
	$dbname = "epiz_29965794_cakeMaker";      //Database name

	$db = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname); 		//database connection
	if(!$db) {die("Error connecting to Database");}
?>