<?php require_once('header.php'); ?>
						
					<?php
					

						require 'databaseconfig.php';

						try {
							$query = "select post_id,price,address,city from houses where user_id=".$_SESSION['id'] ."&& status=1";
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

					<div class="col-md-1">
                                       <h4> <a href="dashbaord.php">Back</a></h4>

					</div>


					<div class="col-md-10">

					<h4 align="center">Properties Posted by You</h4>

					<div class="table-responsive">
							<table class="table table-bordered table-striped">
							  <colgroup>
								<col class="col-xs-1">
								<col class="col-xs-7">
							  </colgroup>
							  <thead>
								<tr>
								  <th>Post ID</th>
								  <th>Price</th>
								  <th>Address</th>
								  <th>City </th>
								  <th>Delete</th>
								</tr>
							  </thead>
							  <tbody>
							  <?php $counter=0 ?>
							  <?php foreach ($row as $key =>$value) : ?>

							  	<form method="post" action="edit.php">
							  <tr>
							  <td><?php echo $row[$counter][0];?></td>
							  <td><?php echo $row[$counter][1];?> INR</td>
							  <td><?php echo $row[$counter][2];?></td>
							  <td><?php echo $row[$counter][3];?></td>
							  <td><a href=<?php echo '"deleteuserpost.php?id='.$row[$counter][0].'"'; ?>>Delete</a></td>
									
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