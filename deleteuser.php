
<?php
require 'databaseconfig.php';

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$id=$_GET['id'];


	$sql = "Update users set status = 0 where id=".$id;
	$result = $conn->query($sql);
	
	header('location:admindashboard.php');

?>

