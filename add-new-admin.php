<?php require_once('header.php'); ?>
<!-- #header end -->

		<section id="page-title">

			<div class="container clearfix">
				<h1>Admin Dashboard</h1>
				<ol class="breadcrumb">
					<li><a href="#">Home</a></li>
					<li><a href="login-register.php">Login</a></li>
                                        <li><a href="admindashboard.php">Dashboard</a></li>
					<li class="active">Add New Admin</li>
				</ol>
			</div>

		</section>



<?php
function sanitize_input($data) {
							  $data = trim($data);
							  $data = stripslashes($data);
							  $data = htmlspecialchars($data);
							  return $data;
							}


if (isset($_POST['submit'])){

			$name=$registeremail=$phone=$registerpassword=$nameErr=$registeremailErr=$phoneErr=$registerpasswordErr="";
							
																	
								require 'databaseconfig.php';

								if (empty($_POST["name"])) {
							    $nameErr = "Name is required";
							  } else {
							    $name = sanitize_input($_POST["name"]);
							    // check if name only contains letters and whitespace
							    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
							      $nameErr = "Only letters and white space allowed"; 
							    }
							  }
							  
							  if (empty($_POST["registeremail"])) {
							    $registeremailErr = "Email is required";
							  } else {
							    $registeremail = sanitize_input($_POST["registeremail"]);
							    // check if e-mail address is well-formed
							    if (!filter_var($registeremail, FILTER_VALIDATE_EMAIL)) {
							      $registeremailErr = "Invalid email format"; 
							    }
							  }
							    
							  if (empty($_POST["phone"])) {
							    $phoneErr = "Mobile Number is Required";
							  } else {
							  		$phone= sanitize_input($_POST['phone']);
							    //to check if the entered string is number or not and is of 10 digits
							    if (!is_numeric($phone) || strlen($phone)!=10) {
							      $phoneErr = "Invalid Mobile Number"; 
							    }
							  }

							   if (empty($_POST["password"])) {
							    $registerpasswordErr = "Password is Required !!";
							  } 
							  else {
							    $registerpassword = sanitize_input($_POST["password"]);
							    $repassword=sanitize_input($_POST['repassword']);
							    if($registerpassword!=$repassword)
							    {
							    	$registerpasswordErr="Password did not Match";
							    }
							    else if(strlen($registerpassword)<7){
							    	$registerpasswordErr="Too Short-Minimum 8 Characters Required";
							    }
							    							    
							  }

								// Check connection
								if ($conn->connect_error) {
								    die("Connection failed: " . $conn->connect_error);
								} 

								if($nameErr=="" && $registeremailErr=="" & $phoneErr=="" && $registerpasswordErr==""){

									$sql = "SELECT id FROM users where email= '$registeremail' || mobile='$phone' ";

									$result = $conn->query($sql);

									if ($result->num_rows == 0) {
									
									$sql = "INSERT INTO users (name, email, mobile, password)	VALUES ('$name', '$registeremail', '$phone', '$registerpassword')";
									
									

								if ($conn->query($sql) === TRUE) {
									$_SESSION['process']="success";
								    header('Location: admindashboard.php');
									 exit();
								} else {
								     echo "<script type='text/javascript'>alert('ERROR!!! Plese Try Again.')</script>";
								}

								$conn->close();

							}
							else{
								 echo "<script type='text/javascript'>alert('Email or Mobile Already Registered!')</script>";
							}
						}

						else{
								 echo "<script type='text/javascript'>alert('Please Check Your Input!')</script>";
							

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
					<li ><a href="update-admin-profile.php">Profile Update</a></li>
					<li class="active"><a href="add-new-admin.php">Add New Admin</a></li>
					<li><a href="show-all-users.php">Show All User</a></li>
					</ul>

					</div>

					<div class="col_three_fourth col_last">

					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"  method="post" enctype="multipart/form-data" >

				<div class="content-wrap">

				<div class="container clearfix">

				<div class="col_one_fourth">
						<h4>Name</h4>
						
					</div>
				<div class="col_one_third">
						
						<input type="text" name="name" class="form-control" value=""><?php echo '<font color="red">'.$nameErr.'</font>'; ?>
						
					</div>

					<div class="clear"></div>


				<div class="col_one_fourth">
						<h4>Email ID</h4>
						
					</div>
				<div class="col_one_third">
						<input type="text" name="registeremail" class="form-control" value""><?php echo '<font color="red">'.$registeremailErr.'</font>'; ?>
						
					</div>

					<div class="clear"></div>

					<div class="col_one_fourth">
						<h4>Mobile Number</h4>
						
					</div>
				<div class="col_one_third">
						
						<input type="text" name="phone" class="form-control" value=""><?php echo '<font color="red">'.$phoneErr.'</font>'; ?>
						
					</div>

					<div class="clear"></div>

					<div class="col_one_fourth">
						<h4>Password</h4>
						
					</div>
				<div class="col_one_third">
						
						<input type="text" name="password" class="form-control" value=""><?php echo '<font color="red">'.$registerpasswordErr.'</font>'; ?>
						
					</div>

					<div class="clear"></div>

					<div class="col_one_fourth">
						<h4>Retype Password</h4>
						
					</div>
				<div class="col_one_third">
						
						<input type="text" name="repassword" class="form-control" value="">
						
					</div>

					<div class="clear"></div>


					<div class="col_one_fourth">
						<button type="reset" class="button button-3d but
						ton-rounded button-red"><i class="icon-repeat"></i>Reset</button>
						
					</div>
				<div class="col_one_fourth">
				<button type="submit" name="submit" class="button button-3d but
						ton-rounded button-green"><i class="icon-ok"></i>Add New Admin</button>
					
						
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