<?php require_once'header.php';?>
<!-- #header end -->
<?php

	function sanitize_input($data) {
							  $data = trim($data);
							  $data = stripslashes($data);
							  $data = htmlspecialchars($data);
							  return $data;
							}

							$name=$email=$phone=$subject=$message=$nameErr=$emailErr=$phoneErr=$subErr=$contentErr="";

							if(isset($_POST['submit'])){
																	
								
								if (empty($_POST["name"])) {
							    $nameErr = "Name is required";
							  } else {
							    $name = sanitize_input($_POST["name"]);
							    // check if name only contains letters and whitespace
							    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
							      $nameErr = "Only letters and white space allowed"; 
							    }
							  }
							  
							  if (empty($_POST["email"])) {
							    $emailErr = "Email is required";
							  } else {
							    $email = sanitize_input($_POST["email"]);
							    // check if e-mail address is well-formed
							    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
							      $emailErr = "Invalid email format"; 
							    }
							  }
							    
							  if (empty($_POST["phone"])) {
							    
							  } else {
							  		$phone= sanitize_input($_POST['phone']);
							    //to check if the entered string is number or not and is of 10 digits
							    if (!is_numeric($phone) || strlen($phone)!=10) {
							      $phoneErr = "Invalid Mobile Number"; 
							    }
							  }

							   if (empty($_POST["subject"])) {
							    $subErr = "Subject is Required !!";
							  } 
							  else {
							  	$query=$_POST['querytype'];
							    $subject = sanitize_input($_POST["subject"])." Query Type:$query";
							    }

							     if (empty($_POST["message"])) {
							    $contentErr = "Message Cannot be Empty !!";
							  } 
							  else {
							    $message = sanitize_input($_POST["message"])." FROM name:$name Email:$email Phone:$phone";
							    }
	
															
								if($nameErr=="" && $emailErr=="" & $phoneErr=="" && $subErr=="" && $contentErr==""){

									

									//sending mail to website owner
                                                                        
									
																		$to="hostelasssist@gmail.com";
																		$from="This User";
																		
																		

                                                                        mail($to, $subject, $message);

                                                                        
									$_SESSION['process']="successcontactus";
								    header('Location: index.php');
									 exit();
								}

							
						else{
								 echo "<script type='text/javascript'>alert('Please Check Your Input!')</script>";
							}
}


 ?>

		<section id="content">

			<div class="content-wrap">

				<div class="container clearfix">

					<!-- Postcontent
					============================================= -->
					<div class="postcontent nobottommargin">

						<h3>Send us an Email</h3>

						<div class="">

						

							<form class="nobottommargin"  name="contact-us" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">

							

								<div class="col_one_third">
									<label for="name">Name <small>*</small></label>
									<input type="text" id="name" name="name" value="<?php if(isset($_POST['name'])){echo $_POST['name'];}?>" class="form-control" /><?php echo '<font color="red">'.$nameErr.'</font>'; ?>
								</div>

								<div class="col_one_third">
									<label for="email">Email <small>*</small></label>
									<input type="email" id="email" name="email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>" class="form-control" /><?php echo '<font color="red">'.$emailErr.'</font>'; ?>
								</div>

								<div class="col_one_third col_last">
									<label for="phone">Phone</label>
									<input type="text" id="phone" name="phone" value="<?php if(isset($_POST['phone'])){echo $_POST['phone'];}?>" class="form-control" /><?php echo '<font color="red">'.$phoneErr.'</font>'; ?>
								</div>

								<div class="clear"></div>

								<div class="col_two_third">
									<label for="subject">Subject <small>*</small></label>
									<input type="text" id="subject" name="subject" value="<?php if(isset($_POST['subject'])){echo $_POST['subject'];}?>" class="form-control" /><?php echo '<font color="red">'.$subErr.'</font>'; ?>
								</div>

								<div class="col_one_third col_last">
									<label for="querytype">Query Type</label>
									<select id="querytype" name="querytype" class="form-control">
										
										<option value="For Renting">For Renting</option>
										<option value="For Buying">For Buying</option>
										<option value="For Selling">For Selling</option>
										<option value="Others">Others</option>
									</select>
								</div>

								<div class="clear"></div>

								<div class="col_full">
									<label for="message">Message <small>*</small></label>
									<textarea class="form-control" id="message" name="message" rows="6" cols="30"><?php if(isset($_POST['content'])){echo $_POST['content'];}?></textarea><?php echo '<font color="red">'.$contentErr.'</font>'; ?>
								</div>

								

								<div class="col_full">
									<button class="button button-3d nomargin" type="submit" id="submit" name="submit" value="submit">Send Message</button>
								</div>

							</form>
						</div>

					</div><!-- .postcontent end -->

					<!-- Sidebar
					============================================= -->
					<div class="sidebar col_last nobottommargin">

						<address>
							<strong>Office:</strong><br>
							Dashmesh Property Dealers,<br>
							Old Phagwara Road,Deep Nagar,
							Jalandhar, Punjab - 144411
							<br>
						</address>
						<abbr title="Phone Number"><strong>Phone:</strong></abbr> (91) 90412 86856<br>
						
						<abbr title="Email Address"><strong>Email:</strong></abbr> hostelasssist@gmail.com

						

						<div class="widget noborder notoppadding">

							<a href="#" class="social-icon si-small si-dark si-facebook">
								<i class="icon-facebook"></i>
								<i class="icon-facebook"></i>
							</a>

							
							</a>

							<a href="#" class="social-icon si-small si-dark si-gplus">
								<i class="icon-gplus"></i>
								<i class="icon-gplus"></i>
							</a>

						</div>

					</div><!-- .sidebar end -->

				</div>

			</div>

		</section>
		<!-- #content end -->


		<!-- Content
		============================================= -->
		<!-- #content end -->

		<!-- Footer
		============================================= -->
		<?php require_once'footer.php'; ?>