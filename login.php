<?php
session_start();
?>
<?php
require 'databaseconfig.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$email=$_POST['email'];
$pass=$_POST['password'];

$sql = "SELECT id,role_id FROM users where email= '$email' && password='$pass' ";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$row= $result->fetch_assoc() ;
	if($row['role_id']==2){
		$_SESSION['id']=$row['id'];
      header('Location: dashboard.php');
	}
  	else if($row['role_id']==1){

  		$_SESSION['id']=$row['id'];

  		header('Location: admindashboard.php');
  	}
    }
 else {
    echo "Check login credentials !";
}
$conn->close();
?>

