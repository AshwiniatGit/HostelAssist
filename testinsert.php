<?php
session_start();
?>

<?php

$tblname="houses";


PDOInsert($_POST,$tblname); 

function PDOInsert($data, $tableName) {

   
	$query = "INSERT INTO {$tableName} ";

	$columnString = "(";

	$columnValueString = "VALUES (";

	foreach ($data as $key => $value) {
		if($key=="upload"){

		}
		else if($key=="size"){

		}
		else
		{
		$columnString .= $key.",";
		if($value=="on")
		$columnValueString .= "'1'".",";
		else
		$columnValueString .= "'{$value}'".",";	
		}
	}
	$columnString .='user_id'.",";
	$columnValueString.="'".$_SESSION['id']."'".",";	

	$img=1;
	$db= mysqli_connect("localhost","root","","hostelassist");
	
	for($i=0;$i<4;$i++)
	{
	

	$target= "images/".basename($_FILES['image'.$img]['name']);
	
	

	$image=$_FILES['image'.$img]['name'];

	$columnString .= 'image'.$img.",";
	$columnValueString .= "'{$image}'".",";	


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
	
	$columnString = rtrim($columnString, ",") . ")";
	$columnValueString = rtrim($columnValueString, ",") . ")";

	$query .= $columnString." ".$columnValueString;
	$sql=$query;
	
	mysqli_query($db,$sql);
	$_SESSION['process']="posted";
	header('Location: dashboard.php');
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