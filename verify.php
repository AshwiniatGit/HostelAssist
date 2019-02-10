<?php

if(isset($_GET['code'])){

        
        require ('databaseconfig.php');

        $vercode= $_GET['code'];

        $sql = "SELECT id FROM users where ver_code='$vercode'";
	$result = $conn->query($sql);
        if ($result->num_rows > 0) {

	$row = $result->fetch_assoc();
              $query="update users set verified=".'1'.", ver_code=NULL "." where id='".$row['id']."' ";
      
        if (mysqli_query($conn, $query)) {
    echo "You have successfully verified your account ! Now you can login on HostelAssist.com <a href='http://www.hostelassist.com/login-register.php' >Login</a>";
	}
	else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

        }

	}
else{
echo " You Cannot Access This Page ";}

 ?>