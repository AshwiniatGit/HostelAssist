<?php require_once('header.php'); ?>

<!-- #header end -->

		<section id="page-title">

			<div class="container clearfix">
				<h1>Admin Dashboard</h1>
				<ol class="breadcrumb">
					<li><a href="#">Home</a></li>
					<li><a href="login-register.php">Login</a></li>
                                        <li><a href="admindashboard.php">Dashboard</a></li>
					<li class="active">Show All Users</li>
				</ol>
			</div>

		</section>

<?php

require 'databaseconfig.php';

try {
	$query = "SELECT id,name,email FROM users where status=1 ";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("$query"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_NUM); 
    $row=$stmt->fetchAll();
    }

catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

		<section id="content">

			<div class="content-wrap">

				<div class="container clearfix">

					<div class="col_one_fourth">

					<h4 align="center">Menu</h4>

					<ul class="nav nav-pills nav-stacked" style="max-width: 300px;">
					<li ><a href="admindashboard.php">Home</a></li>
					<li><a href="update-admin-profile.php">Profile Update</a></li>
					<li><a href="add-new-admin.php">Add New Admin</a></li>
					<li class="active"><a href="show-all-users.php">Show All User</a></li>
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
								  
								  <th>User ID</th>
								  <th>User Name</th>
								  <th>Email </th>
								  <th>Delete</th>
								</tr>
							  </thead>
							  <tbody>
							  <?php $counter=0 ?>
							  <?php foreach ($row as $key =>$value) : ?>

							  	<form method="post" action="edit.php">
							  <tr>
							  <td><?php echo $row[$counter][0];?></td>
							  <td><?php echo $row[$counter][1];?></td>
							  <td><?php echo $row[$counter][2];?></td>
							  <td><a href=<?php echo '"deleteuser.php?id='.$row[$counter][0].'"'; ?>>Delete</a></td>
									
									<?php $counter++;?>


							  </tr>
							  <?php  endforeach; ?>
							  </tbody>
							  </table>

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