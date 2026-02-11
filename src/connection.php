<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db_name = "ictsba";
	$conn = new mysqli($servername, $username, $password, $db_name, 3306);
	if(!$conn){
		die("Connection failed: " . mysqli_connect_error());
	}
	echo "";
?>
