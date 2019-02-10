<?php require_once('header.php'); ?>

		<!-- Content
		============================================= -->

		<section id="slider" class="force-full-screen full-screen">

			<div class="force-full-screen full-screen dark" style="background-image: url('images/landing/landing1.jpg');background-position: 50% 0;">

				<div class="container clearfix">
				<div class="col-md-1"></div>
				<div class="col-md-10">
					<div class="">
					<div class="col_full"><br><br><br><br><br><br><br><br>
						<h1 align="center">HostelAssist</h1>
						<p ><h3 align="center" data-animate="fadeInUp" data-delay="400">Come Look at the Selection  &amp; Find Your Home Like Stay !</h3></p>
						<form action="search-main.php" method="get" role="form" class="nobottommargin">
							<div class="input-group input-group-lg">
								<input type="text" class="form-control" name="city" id="city" placeholder="Enter Your Location...">
								<span class="input-group-btn">
									<button class="btn btn-danger" type="submit" >Search</button>
								</span>
							</div>
						</form>
						</div>
					</div>
					</div>
					<div class="col-md-1"></div>
				</div>

                                                <?php
						 	if(isset($_SESSION['process'])){
						    if ($_SESSION['process']=="successcontactus"){
						        require 'message-contactus.html';
						        $_SESSION['process']="";}
						    
                                                   else if($_SESSION['process']=="successpasswordreset"){
                                                        require 'passwordresetmessage.html';
						        $_SESSION['process']="";}
						    } 
                                               ?>

			</div>

		</section>

		<!-- #content end -->

		<!-- Footer
		============================================= -->
		<?php require_once('footer.php');