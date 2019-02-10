<?php require_once('header.php'); ?>
						<!-- #top-cart end -->

						<!-- Showing Message about registration !!
						============================================= -->
						
						<?php
						 
						    if (isset($_SESSION['process'])){
						    	if($_SESSION['process']=="success")
						    	{
						        require 'registrationmessage.html';
						        $_SESSION['process']="";
						    	}
                                                        if($_SESSION['process']=="passwordreset"){
                                                        require 'passwordresetsuccess.html'; $_SESSION['process']=""; }
						    } else {
						        
						}
						?>
	
							<?php

							function sanitize_input($data) {
							  $data = trim($data);
							  $data = stripslashes($data);
							  $data = htmlspecialchars($data);
							  return $data;
							}

							$email=$password=$emailErr=$passwordErr="";

						
							if(isset($_POST['login-form-submit'])){
							require 'databaseconfig.php';
                                                     
							
							 if (empty($_POST["email"])) {
							    $emailErr = "Email is required";
							  } else {
							    $email = sanitize_input($_POST["email"]);
							    // check if e-mail address is well-formed
							    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
							      $emailErr = "Invalid email format"; 
							    }
							  }
							    
							  if (empty($_POST["password"])) {
							    $passwordErr = "Password is Required !!";
							  } else {
							    $password = sanitize_input($_POST["password"]);
							    							    
							  }

							 							
							// Check connection
							if ($conn->connect_error) {
							    die("Connection failed: " . $conn->connect_error);
							} 

							if($emailErr=="" && $passwordErr==""){
$password=sha1($password);

							$sql = "SELECT id,role_id FROM users where email= '$email' && password='$password' && status=1 && verified=1";
						
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
							     echo "<script type='text/javascript'>alert('Please Check Your Login Credentials!')</script>";
							}
							$conn->close();
						}
						}

						//signup
							$name=$registeremail=$phone=$registerpassword=$nameErr=$registeremailErr=$phoneErr=$registerpasswordErr="";
							if(isset($_POST['register-form-submit'])){
																	
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

									//checking if the user is already registered !!!
									$sql = "SELECT id FROM users where email= '$registeremail' || mobile='$phone' ";

									$result = $conn->query($sql);

									if ($result->num_rows == 0) {
									//sending mail to users
									$verificationcode= mt_rand();
									$to=$registeremail;
									$subject="Verify Your Email Address !";
									$message="

									<html><body>
									Hello <strong> $name </strong> You have just created an account on HostelAssist.com.
									Please verify your email by clicking the below link : <br/>
									<a href='http://www.hostelassist.com/verify.php?code=$verificationcode'>Click On This Link to Verify </a><br/>
									<strong> Thank You for registering with us.</strong>
									</body>
									</html>

									";


									$headers = "MIME-Version: 1.0" . "\r\n";
									$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

									// More headers
									$headers .= 'From: <Admin@HostelAssist.com>' . "\r\n";
									
									mail($to,$subject,$message,$headers);
$registerpassword=sha1($registerpassword);


									
									$sql = "INSERT INTO users (name, email, mobile, password, ver_code)	VALUES ('$name', '$registeremail', '$phone', '$registerpassword','$verificationcode')";
									
									

								if ($conn->query($sql) === TRUE) {
									$_SESSION['process']="success";
								    header('Location: login-register.php');
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

<!--			<div class="force-full-screen full-screen dark" style="background-image: url('images/landing/landing1.jpg');background-position: 50% 0;"> -->
			<div class="content-wrap">



				<div class="container clearfix">

					<div class="tabs divcenter nobottommargin clearfix" id="tab-login-register" style="max-width: 500px;">

						<ul class="tab-nav tab-nav2 center clearfix">
							<li class="inline-block"><a href="#tab-login">Login</a></li>
							<li class="inline-block"><a href="#tab-register">Register</a></li>
						</ul>

						<div class="tab-container">

							<div class="tab-content clearfix" id="tab-login">
								<div class="panel panel-default nobottommargin">
									<div class="panel-body" style="padding: 40px;">
										<form id="login-form" name="login-form" class="nobottommargin" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">

											<h3>Login to your Account</h3>

											<div class="col_full">
												<label for="login-form-username">Email-ID:<?php echo '<font color="red">'.$emailErr.'</font>'; ?></label>
												<input type="text" id="login-form-username" name="email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>" class="form-control" />
											</div>

											<div class="col_full">
												<label for="login-form-password">Password:<?php echo '<font color="red">'.$passwordErr.'</font>'; ?></label>
												<input type="password" id="login-form-password" name="password" value="" class="form-control" />
											</div>

											<div class="col_full nobottommargin">
												<button class="button button-3d button-black nomargin" id="login-form-submit" name="login-form-submit" value="login">Login</button>
												<a href="forgot-password.php"  class="fright">Forgot Password?</a>
											</div>

										</form>
									</div>
								</div>
							</div>

							<div class="tab-content clearfix" id="tab-register">
								<div class="panel panel-default nobottommargin">
									<div class="panel-body" style="padding: 40px;">
										<h3>Register for an Account</h3>

										<form id="register-form" name="register-form" class="nobottommargin" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">

											<div class="col_full">
												<label for="register-form-name">Name:<?php echo '<font color="red">'.$nameErr.'</font>' ; ?></label>
												<input type="text" id="register-form-name" name="name" value="<?php if(isset($_POST['name'])){echo $_POST['name'];}?>" class="form-control" />
											</div>

											<div class="col_full">
												<label for="register-form-email">Email Address:<?php echo '<font color="red">'.$registeremailErr.'</font>'; ?></label>
												<input type="text" id="register-form-email" name="registeremail" value="<?php if(isset($_POST['registeremail'])){echo $_POST['registeremail'];}?>" class="form-control" />
											</div>

											<div class="col_full">
												<label for="register-form-phone">Phone:<?php echo '<font color="red">'.$phoneErr.'</font>'; ?></label>
												<input type="text" id="register-form-phone" name="phone" value="<?php if(isset($_POST['phone'])){echo $_POST['phone'];}?>" class="form-control" />
											</div>

											<div class="col_full">
												<label for="register-form-password">Choose Password:<?php echo '<font color="red">'.$registerpasswordErr.'</font>'; ?></label>
												<input type="password" id="register-form-password" name="password" value="" class="form-control" />
											</div>

											<div class="col_full">
												<label for="register-form-repassword">Re-enter Password:</label>
												<input type="password" id="register-form-repassword" name="repassword" value="" class="form-control" />
											</div>

											<div class="col_full nobottommargin">
												<button class="button button-3d button-black nomargin" id="register-form-submit" name="register-form-submit" value="register">Register Now</button>
											</div>

										</form>
									</div>
								</div>
							</div>

						</div>

					</div>

				</div>

			</div>

		</section>

		<!-- Content
		============================================= -->
		<!-- #content end -->

		<!-- Footer
		============================================= -->
		<?php require_once('footer.php'); ?>