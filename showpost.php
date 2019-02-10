<?php require_once('header.php'); ?>
<!-- #header end -->


			<?php
			require 'databaseconfig.php';

			try {
				$query= "SELECT price,post_id,image1,image2 FROM houses where user_id=".$_SESSION['id']." && status=1";
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


		<!-- Content
		============================================= -->
<br>
				<section id="content">

			<div class="content-wrap">

				<div class="container clearfix">

					<!-- Post Content
					============================================= -->
					
					<div class="postcontent nobottommargin col_last">

						<div id="shop" class="shop product-2 clearfix">


						<?php foreach ($row as $key ) : ?>

							<div class="product clearfix">
						
								<div class="product-image">

									<a href=<?php echo '"showpostdetail.php?postid='.$key[1].'"';?>><img src='images/<?php if($key[2]==""){ echo "imagenotavailable.jpg"; } else {echo "$key[2]";} ?> ' alt="" style="height: 232px; width: 411px;"></a>
									<a href=<?php echo '"showpostdetail.php?postid='.$key[1].'"';?>><img src='images/<?php if($key[3]==""){ echo "imagenotavailable.jpg"; } else {echo "$key[3]";} ?> ' alt="" style="height: 232px; width: 411px;"></a>
									
									
									
									
								</div>
								<div class="product-desc center">
									
									<div class="product-price"><ins><?php echo $key[0]; ?> INR</ins></div>
									
								</div>
							</div>
							<?php  endforeach; ?>

							
						</div><!-- #shop end -->

					</div>


					<div class="sidebar nobottommargin">
						<div class="sidebar-widgets-wrap">

							
							<form method="post" action="filter.php" id="filter" enctype="multipart/form-data">
							<div class="widget clearfix">

								<h4>Property Posted By You</h4>
								<div id="post-list-footer">

									
									<div class="spost clearfix">
										<div class="">
											<a href="dashboard.php">Back to Dashboard</a> 
										</div>
										
									</div>

								

</div></div></form></section>

					<!-- .postcontent end -->

		<!-- #content end -->

		<!-- Footer
		============================================= -->
		<?php require_once('footer.php'); ?>