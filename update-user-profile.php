<?php require_once('header.php'); ?>

<?php

	require 'databaseconfig.php';

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT * FROM users where id=".$_SESSION['id'];
	$result = $conn->query($sql);
	$row=$result->fetch_assoc();
	

	if ($result->num_rows > 0) {
	    
	     
	    }
	 else {
	    echo "Unable Fetch Post Details ! Please Try Again ";
	}




?>
<?php 				$name=$mobile=$password=$nameErr=$mobileErr=$passwordErr="";

					if (isset($_POST['submit'])){

						

							function sanitize_input($data) {
							  $data = trim($data);
							  $data = stripslashes($data);
							  $data = htmlspecialchars($data);
							  return $data;
							}

							

							if (empty($_POST["name"])) {
							     $nameErr="Required !!"; }
							else{ 
							    // check if name only contains letters and whitespace
							    $name = sanitize_input($_POST["name"]);
									if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
									  $nameErr = "Only letters and white space allowed"; 
									}
							  }
							    
							  if (empty($_POST["password"])) {
							    $passwordErr = "Required !!";
							  }
							  else {
							  	if(strlen($_POST['password'])<8){
							  		$passwordErr="Mininum 8 characters ";
							  	}
							  					    
							  }

								if (empty($_POST["mobile"])) {
							    $mobileErr = "Required !!";
							  } else {
							  	if(strlen($_POST['mobile'])!=10 )
							  		{
							  			$mobileErr="Invalid Mobile No.";
							  		}
							  		else{
							    $mobile = sanitize_input($_POST["mobile"]);
							    		}					    
							  }

							  if($nameErr=="" && $mobileErr=="" && $passwordErr=="")
							  {

								// Create connection
								require('databaseconfig.php');
								// Check connection
								if ($conn->connect_error) {
								    die("Connection failed: " . $conn->connect_error);
								} 

								$sql = "Update users set name='".$name."' , mobile='".$mobile."', password='".sanitize_input($_POST['password'])."' where id=".$_SESSION['id'];
								
								
								$result = $conn->query($sql);
								$_SESSION['process']="updated";
								header('location:dashboard.php');
							}
	
	

}
?>

<div id="page-menu">

			<div id="page-menu-wrap">

				<div class="container clearfix">

					<div class="menu-title">Update Your Profile</div>

					<nav>
						<ul>
							<li ><a href="add-your-property.php"><div>Add New Property</div></a></li>
							<li ><a href="editpost.php" ><div>Edit Post</div></a></li>
							<li><a href="showpost.php"><div>View Post</div></a></li>
							<li><a href="dashboard.php"><div>Back To Dashboard</div></a></li>
						</ul>
					</nav>

				</div>

			</div>

</div>

<section id="content">
			
				
		<div class="content-wrap">

				<div class="container clearfix">

			

					<div class="col-md-3"></div>
					<div class="col-md-9">
					<form action=""  method="post" enctype="multipart/form-data" >

				

				<div class="col_one_fourth">
						<h4>Name:</h4>
						
					</div>
				<div class="col_one_third">
						
						<input type="text" name="name" class="form-control" value="<?php echo $row['name'] ?>"><?php echo '<font color="red">'.$nameErr.'</font>'; ?>
						
					</div>

					<div class="clear"></div>


				<div class="col_one_fourth">
						<h4>Email ID:</h4>
						
					</div>
				<div class="col_one_third">
						<input type="text" name="email" class="form-control" value="<?php echo $row['email'] ?>"  readonly="">
						
					</div>

					<div class="clear"></div>

					<div class="col_one_fourth">
						<h4>Mobile Number:</h4>
						
					</div>
				<div class="col_one_third">
						
						<input type="text" name="mobile" class="form-control" value="<?php echo $row['mobile'] ?>"><?php echo '<font color="red">'.$mobileErr.'</font>'; ?>
						
					</div>

					<div class="clear"></div>

					<div class="col_one_fourth">
						<h4>Password:</h4>
						
					</div>
				<div class="col_one_third">
						
						<input type="password" name="password" class="form-control" value=""><?php echo '<font color="red">'.$passwordErr.'</font>'; ?>
						
					</div>

					<div class="clear"></div>

					<div class="col_one_fourth">
						<button type="reset" class="button button-3d but
						ton-rounded button-red"><i class="icon-repeat"></i>Reset</button>
						
					</div>
				<div class="col_one_fourth">
				<button type="submit" name="submit" class="button button-3d but
						ton-rounded button-green"><i class="icon-ok"></i>Update Profile</button>
					
						
					
					</form>
					</div>
					<div class="clear"></div>

				</div>
			
			</div>

		</section>





		<!-- Content
		============================================= -->
		<!-- #content end -->

		<!-- Footer
		============================================= -->
		<?php require_once('footer.php'); ?>