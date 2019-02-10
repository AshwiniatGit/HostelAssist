<?php require_once('header.php'); ?>
<!-- #header end -->

		<section id="page-title">

			<div class="container clearfix">
				<h1>Admin Dashboard</h1>
				<ol class="breadcrumb">
					<li><a href="index.php">Home</a></li>
					<li><a href="login-register.php">Login</a></li>
					<li class="active">Admin Home</li>
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

	$sql = "SELECT post_id,user_id,city,users.name FROM houses,users where houses.user_id=users.id && houses.status=1";
	$result = $conn->query($sql);
	$row=$result->fetch_all();
	var_dump($row);

	if ($result->num_rows > 0) {
	    
	     
	    }
	 else {
	    echo "Unable Fetch Post Details ! Please Try Again ";
	}




?>

		<section id="content">

			<div class="content-wrap">

				<div class="container clearfix">

					<div class="col_one_fourth">

					<h4 align="center">Menu</h4>

					<ul class="nav nav-pills nav-stacked" style="max-width: 300px;">
					<li class="active"><a href="admindashboard.php">Home</a></li>
					<li><a href="update-admin-profile.php">Profile Update</a></li>
					<li><a href="add-new-admin.php">Add New Admin</a></li>
					<li><a href="show-all-user.php">Show All User</a></li>
					</ul>

					</div>

					<div class="col_three_fourth col_last">

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