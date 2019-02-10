<?php session_start(); ?>

<?php

$tblname="houses";


PDOUpdate($_POST,$tblname); 

function PDOUpdate($data, $tableName) {

/*
$servername = "localhost";
$username = "root";
$password = "";

try {
	    $conn = new PDO("mysql:host=$servername;dbname=hostelassist", $username, $password);
	    
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	    echo "Connected successfully"; 
    }
	catch(PDOException $e) {
    	echo "Connection failed: " . $e->getMessage();
    }

*/
    
    $post_id= $_POST['postid'];
    echo "$post_id";
   
	$query = "update {$tableName} set ";

	
	$columnString = "";

	foreach ($data as $key => $value) {
		if($key=="upload"){

		}
		else if($key=="postid"){

		}
		else if($key=="size"){

		}
		else
		{
		$columnString .= $key."=";
		if($value=="on")
		$columnString .= "'1'".",";
		else
		$columnString .= "'{$value}'".",";	
		}
	}

	$columnString = rtrim($columnString, ",") ;
	$columnString .=' where post_id=';
	$columnString.="$post_id";	

	$img=1;
	$db= mysqli_connect("localhost","root","","hostelassist");
	$_SESSION['process']="updatedpost";
	header('Location: editpost.php');
	
	/* for($i=0;$i<4;$i++)
	{
	

	$target= "images/".basename($_FILES['image'.$img]['name']);
	va
	

	$image=$_FILES['image'.$img]['name'];

	$columnString .= 'image'.$img.",";
	$columnString .= "'{$image}'".",";	


		if(move_uploaded_file($_FILES['image'.$img]['tmp_name'], $target)){
		$msg="Image upload !!!";
		

	} 
	else
	{
		$msg="Problem !!!";
		echo "Problem";
	}

	$img++;
	
	}
	*/ 
	$columnString = rtrim($columnString, ",") ;
	$columnString = rtrim($columnString, ",") ;

	$query .= $columnString;
	
	$sql=$query;
	
	mysqli_query($db,$sql);
	
}
	
	/*try {
		if (!$conn->query($query)) {
			echo "Some pdo error occured";
			return;
		}
		echo "Inserted successfully";
		return;
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}

	}*/
	?>