<?php require_once('header.php'); ?>
<!-- #header end -->

		<?php

	require 'databaseconfig.php';


	try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT post_id,user_id,city,users.name FROM houses,users where houses.user_id=users.id && houses.status=1"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_NUM); 
    $row=$stmt->fetchAll();
    
    
		}

	catch(PDOException $e) {
    	echo "Error: " . $e->getMessage();
    }
    $query="SELECT name FROM users where id=".$_SESSION['id'];
 	$stmt = $conn->prepare("$query"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_BOTH); 
    $ans=$stmt->fetchAll();
    
   ?>


		<section id="page-title">

			<div class="container clearfix">
				<h1>Admin Dashboard - Welcome <?php echo $ans[0][0]; ?></h1>
				<ol class="breadcrumb">
					<li><a href="index.php">Home</a></li>
					<li><a href="login-register.php">Login</a></li>
					<li class="active">Admin Home</li>
				</ol>
			</div>

		</section>



		<section id="content">

			<div class="content-wrap">

				<div class="container clearfix">

					<div class="col_one_fourth">

					<h4 align="center">Menu</h4>

					<ul class="nav nav-pills nav-stacked" style="max-width: 300px;">
					<li class="active"><a href="admindashboard.php">Home</a></li>
					<li><a href="update-admin-profile.php">Profile Update</a></li>
					<li><a href="add-new-admin.php">Add New Admin</a></li>
					<li><a href="show-all-users.php">Show All User</a></li>
					</ul>

					</div>


					<div class="col_three_fourth col_last">

					<div class="table-responsive">
							<table class="table table-bordered table-striped">
							  <colgroup>
								<col class="col-xs-1">
								<col class="col-xs-7">
							  </colgroup>
							  <thead>
								<tr>
								  <th>Post ID</th>
								  <th>User ID</th>
								  <th>User Name</th>
								  <th>City </th>
								  <th>Delete</th>
								</tr>
							  </thead>
							  <tbody>
							  <?php $counter=0 ?>
							  <?php foreach ($row as $key =>$value) : ?>

							  
							  <tr>
							  <td><?php echo $row[$counter][0];?></td>
							  <td><?php echo $row[$counter][1];?></td>
							  <td><?php echo $row[$counter][3];?></td>
							  <td><?php echo $row[$counter][2];?></td>
							  <td><a href=<?php echo '"deletepost.php?id='.$row[$counter][0].'"'; ?>>Delete</a></td>
									
									<?php $counter++;?>


							  </tr>
							  <?php  endforeach; ?>
							  </tbody>
							  </table>

					</div>

					 <?php if(isset($_SESSION['process']) && $_SESSION['process']=="updated"){require "profileupdatedmessage.html"; $_SESSION['process']=""; }   ?>
					 <?php if(isset($_SESSION['process']) && $_SESSION['process']=="success"){require "addednewadmin.php"; $_SESSION['process']=""; }   ?>
			
			</div>
				</div>
		</section>



		<!-- Content
		============================================= -->
		<!-- #content end -->

		<!-- Footer
		============================================= -->
		<?php require_once('footer.php'); ?>