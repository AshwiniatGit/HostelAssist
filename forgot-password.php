<?php require_once('header.php') ?>
<?php 
$email=$emailErr="";

function sanitize_input($data) {
							  $data = trim($data);
							  $data = stripslashes($data);
							  $data = htmlspecialchars($data);
							  return $data;
							}

if(isset($_POST['submit']))
{
	 if (empty($_POST["email"])) {
							    $registeremailErr = "Email is required";
							  } else {
							    $email = sanitize_input($_POST["email"]);
							    // check if e-mail address is well-formed
							    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
							      $emailErr = "Invalid email format"; 
							    }
							    else
							    {
							    	require('databaseconfig.php');
                                    $query="select id from users where email='$email'";
                                    $result = $conn->query($query);

									if ($result->num_rows > 0) {
                                    $row= $result->fetch_assoc() ;
                                    $id=$row['id'];
									$verificationcode= mt_rand();
									$to=$email;
									$subject="Password Reset !";
									$message="

									<html><body>
									Hello Here is your link to reset your password for your account on HostelAssist.com.
									To reset your password click the below link : <br/>
									<a href='http://www.hostelassist.com/password-reset-confirm.php?code=$verificationcode'>Click On This Link to Reset your Account Password </a><br/>
									Please ignore if you did not request for this.
									</body>
									</html>

									";


									$headers = "MIME-Version: 1.0" . "\r\n";
									$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

									// More headers
									$headers .= 'From: <Admin@HostelAssist.com>' . "\r\n";
									
									mail($to,$subject,$message,$headers);

									$sql="update users set passwordreset='$verificationcode' where id =$id";
									if ($conn->query($sql) === TRUE) {
									$_SESSION['process']="successpasswordreset";
								    header('Location: index.php');
									 exit();
								} else {
								     echo "<script type='text/javascript'>alert('ERROR!!! Plese Try Again.')</script>";
								}

									
									}

							    	}
							  	}




}


?>


		<section id="content">

			<div class="content-wrap">

				<div class="container clearfix">

				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"  method="post" enctype="multipart/form-data" >
				<h3>Forgot Password ?</h3>
				<div class="col_one_fourth">
						<h4>Email ID</h4>
						
					</div>
				<div class="col_one_third">
						<input type="text" name="email" class="form-control" value""><?php echo '<font color="red">'.$emailErr.'</font>'; ?>
						
					</div>

					<div class="col_one_fourth">
				<button type="submit" name="submit" class="button button-3d but
						ton-rounded button-green"><i class="icon-ok"></i>Confirm Email</button>
					
						
					</div>

					<div class="clear"></div>



				</div><!-- #shop end -->

			</div>


								

		</section>





<?php require_once('footer.php') ?>
