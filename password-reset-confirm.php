	<?php require_once('header.php'); ?>
	<?php
//check if the user has the verification link

	if(isset($_GET['code'])){

	        
	    require ('databaseconfig.php');

		$vercode= $_GET['code'];
	
		if($vercode==NULL) {echo " You Cannot Access This Page ";}
	
		else{
			
			//checking if the resetpassword button is clicked

			if(isset($_POST['resetpassword'])){
		
		$password=$passwordErr="";

		function sanitize_input($data) {
							  $data = trim($data);
							  $data = stripslashes($data);
							  $data = htmlspecialchars($data);
							  return $data;
							}

							if (empty($_POST["password"])) {
							    $passwordErr = "Password is Required !!";
							  } 
							  else {
							    $password = sha1(sanitize_input($_POST["password"]));
							   						    
							    if(strlen($password)<8){
							    	$passwordErr="Too Short-Minimum 8 Characters Required";
							    }
							    							    
							  }

   if($passwordErr==""){
	        $sql = "SELECT id FROM users where passwordreset='$vercode'";
		$result = $conn->query($sql);
	        if ($result->num_rows > 0) {


		$row = $result->fetch_assoc();
	              $query="update users set password="."'$password'".", passwordreset=NULL "." where id='".$row['id']."' ";
	      
	        if (mysqli_query($conn, $query)) {
	    echo "<script type='text/javascript'>alert('Password Reset Successful !')</script>";
                        $_SESSION['process']="passwordreset";
	    		header('location: login-register.php');
											 }

		else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			 }

	        							}
						}
			}

		}
	}
	
//if verification code is missing 
	else{
	echo "<script type='text/javascript'>alert('Cannot Access this page. Permissions Required!')</script>"; die();}

	 ?>


	 	<section id="content">

			<div class="content-wrap">

				<div class="container clearfix">

				<form action=""  method="post" enctype="multipart/form-data" >
				<h3>Password Reset</h3>
				<div class="col_one_fourth">
						<h4>New Password</h4>
						
					</div>
				<div class="col_one_third">
						<input type="password" name="password" class="form-control" value""><?php echo '<font color="red">'.$passwordErr.'</font>'; ?>
						
					</div>

					<div class="col_one_fourth">
				<button type="submit" name="resetpassword" class="button button-3d but
						ton-rounded button-green"><i class="icon-ok"></i>Set New Password</button>
					
						
					</div>

					<div class="clear"></div>



				</div><!-- #shop end -->

			</div>


								

		</section>





<?php require_once('footer.php') ?>
