<?php require_once('header.php'); ?>
<!-- #header end -->

		<section id="page-title">

			<div class="container clearfix">
				<h1>Admin Dashboard</h1>
				<ol class="breadcrumb">
					<li><a href="#">Home</a></li>
					<li><a href="login-register.php">Login</a></li>
					<li class="active">Admin Profile Update</li>
				</ol>
			</div>

		</section>

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
							  		else{
							    $password = sanitize_input($_POST["password"]);
							    		}					    
							  }

								if (empty($_POST["mobile"])) {
							    $mobileErr = "Required !!";
							  } else {
							  	if(strlen($_POST['mobile'])!=10)
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

								$sql = "Update users set name='".$name."' , mobile='".$mobile."', password='".sha1(sanitize_input($_POST['password']))."' where id=".$_SESSION['id'];
							
							
								$result = $conn->query($sql);
								$_SESSION['process']="updated";
								header('location:admindashboard.php');
							}
	
	

}
?>


		<section id="content">

			<div class="content-wrap">

				<div class="container clearfix">

					<div class="col_one_fourth">

					<h4 align="center">Menu</h4>

					<ul class="nav nav-pills nav-stacked" style="max-width: 300px;">
					<li ><a href="admindashboard.php">Home</a></li>
					<li class="active"><a href="update-admin-profile.php">Profile Update</a></li>
					<li><a href="add-new-admin.php">Add New Admin</a></li>
					<li><a href="show-all-users.php">Show All User</a></li>
					</ul>

					</div>

					<div class="col_three_fourth col_last">

					<form action=""  method="post" enctype="multipart/form-data" >

				<div class="content-wrap">

				<div class="container clearfix">

				<div class="col_one_fourth">
						<h4>Name</h4>
						
					</div>
				<div class="col_one_third">
						
						<input type="text" name="name" class="form-control" value="<?php echo $row['name'] ?>">
						<?php echo '<font color="red">'.$nameErr.'</font>'; ?>
						
					</div>

					<div class="clear"></div>


				<div class="col_one_fourth">
						<h4>Email ID</h4>
						
					</div>
				<div class="col_one_third">
						<input type="text" name="email" class="form-control" value="<?php echo $row['email'] ?>"  readonly="">

						
					</div>

					<div class="clear"></div>

					<div class="col_one_fourth">
						<h4>Mobile Number</h4>
						
					</div>
				<div class="col_one_third">
						
						<input type="text" name="mobile" class="form-control" value="<?php echo $row['mobile'] ?>">
						<?php echo '<font color="red">'.$mobileErr.'</font>'; ?>
						
					</div>

					<div class="clear"></div>

					<div class="col_one_fourth">
						<h4>Password</h4>
						
					</div>
				<div class="col_one_third">
						
						<input type="password" name="password" class="form-control" value="">
						<?php echo '<font color="red">'.$passwordErr.'</font>'; ?>
						
					</div>

					<div class="clear"></div>

					<div class="col_one_fourth">
						<button type="reset" class="button button-3d but
						ton-rounded button-red"><i class="icon-repeat"></i>Reset</button>
						
					</div>
				<div class="col_one_fourth">
				<button type="submit" name="submit" class="button button-3d but
						ton-rounded button-green"><i class="icon-ok"></i>Update Profile</button>
					
						
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