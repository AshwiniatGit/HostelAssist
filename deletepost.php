<?php
require 'databaseconfig.php';
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$postid=$_GET['id'];

	$sql = "Update houses set status = 0 where post_id=".$postid;
	$result = $conn->query($sql);
	
	
	header('location:admindashboard.php');
?>