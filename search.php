<?php
require 'databaseconfig.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$cty=$_POST['city'];


$sql = "SELECT * FROM houses where city='$cty' ";
$result = $conn->query($sql);
var_dump($result);
if ($result->num_rows > 0) {
	$row= $result->fetch_assoc() ;
     echo "Match Found !" ;
    }
 else {
    echo "No Match found !";
}
$conn->close();
?>


