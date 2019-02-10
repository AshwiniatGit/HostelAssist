<?php session_start(); ?>

<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

	<!-- Stylesheets
	============================================= -->
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="style.css" type="text/css" />
	<link rel="stylesheet" href="css/swiper.css" type="text/css" />
	<link rel="stylesheet" href="css/dark.css" type="text/css" />
	<link rel="stylesheet" href="css/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="css/animate.css" type="text/css" />
	<link rel="stylesheet" href="css/magnific-popup.css" type="text/css" />
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	

	<link rel="stylesheet" href="css/responsive.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- Document Title
	============================================= -->
	<title>HostelAssist - Find Your Home Like Stay ! </title>

</head>

<body class="stretched">

<!-- Google tracking code -->

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-98633176-1', 'auto');
  ga('send', 'pageview');

</script>

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Header
		============================================= -->
		<header id="header" class="full-header">

			<div id="header-wrap">

				<div class="container clearfix">

					<div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

					<!-- Logo
					============================================= -->
					<div id="logo">
						<a href="index.php" class="standard-logo" data-dark-logo="images/logo-dark.png"><img src="images/logo.png" alt="HostelAssist Logo"></a>
						<a href="index.php" class="retina-logo" data-dark-logo="images/logo-dark.png"><img src="images/logo.png" alt="HostelAssist Logo"></a>
					</div><!-- #logo end -->



		<?php

	require 'databaseconfig.php';

	$roleid=NULL;

if(isset($_SESSION['id'])){
	try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query="SELECT role_id FROM users where id='".$_SESSION['id']."'";
    $stmt = $conn->prepare("$query"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_NUM); 
    $row=$stmt->fetchAll();

    $roleid= $row[0][0];
    
    
    
		}

	catch(PDOException $e) {
    	echo "Error: " . $e->getMessage();
    }
}
?>

					<!-- Primary Navigation
					============================================= -->
					<nav id="primary-menu">

						<ul>
							<li ><a href="index.php"><div>Home</div></a>
								
							<li><a href="process-steps.php"><div>Post Your Property</div></a>
								
											
							</li>
							<li ><a href="#"><div>About Us</div></a>
								
							</li>
							<li ><a href="contact-us.php"><div>Contact Us</div></a>
								
							</li>

							<li><a href="advertise-with-us.php"><div>Advertise with Us</div></a>
								
							</li>



							<?php if(isset($_SESSION['id'])){ if($roleid==1) {echo "<li class='mega-menu'><a href="."'admindashboard.php'".">Dashboard</a></li>";echo '<li class="mega-menu"> <a href="logout.php">Logout</a></li>';} else{ echo "<li class='mega-menu'><a href="."'dashboard.php'".">Dashboard</a></li>";echo '<li class="mega-menu"> <a href="logout.php">Logout</a></li>';}} else{echo '<li class="mega-menu"><a href="login-register.php" ><div>Login/Register</div></a></li>'; } ?>
							
							</li>
						</ul>
						<!-- #top-cart end -->

						<!-- Top Search
						============================================= -->

						
					</nav><!-- #primary-menu end -->

				</div>

			</div>

		</header><!-- #header end -->


<?php

require 'databaseconfig.php';

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$id=$_GET['postid'];


	$sql = "SELECT * FROM houses where post_id=$id ";
	$result = $conn->query($sql);
	$row=$result->fetch_assoc();

	if ($result->num_rows > 0) {
	    
	     
	    }
	 else {
	    echo "Unable Fetch Post Details ! Please Try Again ";
	}


?>

<section id="page-title">

			<div class="container clearfix">
				<h1>View Property Details  </h1>
				<span>Find Your Home Like Stay </span>
				<ol class="breadcrumb">
					<li><a href="index.php">Home</a></li>
					<?php if(isset($_SESSION['id'])){echo "<li><a href='dashboard.php'>Dashboard</a></li><li><a href='showpost.php'>View Post</a></li>"; } else{ echo "<li> Search </li>";} ?> 
					<li class="current">View Property Details</li>
					
				</ol>
			</div>

</section>

<section id="content">

			<div class="content-wrap">

				<div class="container clearfix">

					<h2 class="w3-center">Property Images</h2>

						<div class="w3-content w3-display-container">
                                                 <?php if($row['image1']=="")
                                                        { $img1= "imagenotavailable.jpg";} else {$img1=$row['image1'];} 
if($row['image2']=="")
                                                        { $img2= "imagenotavailable.jpg";} else {$img2=$row['image2'];} 
if($row['image3']=="")
                                                        { $img3= "imagenotavailable.jpg";} else {$img3=$row['image3'];} 
if($row['image4']=="")
                                                        { $img4= "imagenotavailable.jpg";} else {$img4=$row['image4'];}  ?>
						  <img class="mySlides" src=<?php echo  "'images/".$img1."'"; ?>  style="height:500px" align="center">
						  <img class="mySlides" src=<?php echo  "'images/".$img2."'"; ?> style="height:500px" align="center">
						  <img class="mySlides" src=<?php echo  "'images/".$img3."'"; ?> style="height:500px" align="center">
						  <img class="mySlides" src=<?php echo  "'images/".$img4."'"; ?> style="height:500px" align="center">

						  <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
						  <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
						</div>
					
				</div>

			</div>

		<div class="line"></div>

					<div class="col-md-1"></div>

					<div class="col-md-10">

						<h4>Property Details </h4>

						<div class="table-responsive">
							<table class="table table-bordered table-striped">
							  <colgroup>
								<col class="col-xs-1">
								<col class="col-xs-7">
							  </colgroup>
							  <thead>
								<tr>
								  <th>Feature</th>
								  <th>Description</th>
								</tr>
							  </thead>
							  <tbody>
							  <tr>
							  <td>Price</td>
							  <td><?php echo $row['price'];?></td>
							  </tr>

							  <tr>
							  <td>Type</td>
							  <td><?php if($row['type']==0){echo "Flat ";} else if($row['type']==1){echo "P.G. ";}
							  		else {echo "Independent";}?></td>
							  </tr>

							  <tr>
							  <td>Furnishing</td>
							  <td><?php if($row['furnished']==0){echo "Non - Furnished ";} else if($row['furnished']==1){echo "Semi - Furnished ";}	else {echo "Fully - Furnished";}?></td>
							  </tr>

							  <tr>
							  <td>Available From</td>
							  <td><?php if($row['availablemonth']==0){echo "January"; } else if($row['availablemonth']==1){echo "February";}
							  		else if($row['availablemonth']==2){echo "March";} else if($row['availablemonth']==3){echo "April";}
							  		else if($row['availablemonth']==4){echo "May";} else if($row['availablemonth']==5){echo "June";}
							  		else if($row['availablemonth']==6){echo "July";} else if($row['availablemonth']==7){echo "August";}
							  		else if($row['availablemonth']==8){echo "September";} else if($row['availablemonth']==9){echo "October";}
							  		else if($row['availablemonth']==10){echo "November";} else if($row['availablemonth']==11){echo "December";
							  		}?></td>
							  </tr>

							  <tr>
							  <td>Address</td>
							  <td><?php if($row['showaddress']=='1') { echo $row['address']; } else {echo "Contact the Owner for exact Address Location  "; }?></td>
							  </tr>

							  <tr>
							  <td>City</td>
							  <td><?php echo $row['city'];?></td>
							  </tr>

							  <tr>
							  <td>Pincode</td>
							  <td><?php echo $row['pincode'];?></td>
							  </tr>

							  <tr>
							  <td>Bedroom(s)</td>
							  <td><?php echo $row['bedroom'];?></td>
							  </tr>

							  <tr>
							  <td>Washroom(s)</td>
							  <td><?php echo $row['washroom'];?></td>
							  </tr>

							  <tr>
							  <td>Kitchen</td>
							  <td><?php echo $row['kitchen'];?></td>
							  </tr>

							  <tr>
							  <td>AC</td>
							  <td><?php  if($row['ac']==1){echo "YES";} else {echo "NO";};?></td>
							  </tr>

							  <tr>
							  <td>Cooler</td>
							  <td><?php  if($row['cooler']==1){echo "YES";} else {echo "NO";};?></td>
							  </tr>

							  <tr>
							  <td>Refrigerator</td>
							  <td><?php  if($row['fridge']==1){echo "YES";} else {echo "NO";};?></td>
							  </tr>

							  <tr>
							  <td>Water Purifier</td>
							  <td><?php  if($row['waterpurifier']==1){echo "YES";} else {echo "NO";};?></td>
							  </tr>

							  <tr>
							  <td>Wi-fi</td>
							  <td><?php  if($row['wifi']==1){echo "YES";} else {echo "NO";};?></td>
							  </tr>

							  <tr>
							  <td>Geyser</td>
							  <td><?php  if($row['geyser']==1){echo "YES";} else {echo "NO";};?></td>
							  </tr>

							  <tr>
							  <td>Inverter</td>
							  <td><?php  if($row['inverter']==1){echo "YES";} else {echo "NO";};?></td>
							  </tr>

							  <tr>
							  <td>Television</td>
							  <td><?php  if($row['tv']==1){echo "YES";} else {echo "NO";};?></td>
							  </tr>

							  <tr>
							  <td>Parking</td>
							  <td><?php  if($row['parking']==1){echo "YES";} else {echo "NO";};?></td>
							  </tr>

							  <tr>
							  <td>Security</td>
							  <td><?php  if($row['security']==1){echo "YES";} else {echo "NO";};?></td>
							  </tr>

							  <tr>
							  <td>Additional Information</td>
							  <td><?php  if($row['other']==""){echo "N.A.";} else {echo $row['other'];};?></td>
							  </tr>
							 </tbody>
							 </table>
						  </div>

						  <div class="col-md-1"></div>
						  <div class="line"></div>

						  <?php 


								// Create connection
								$conn = new mysqli($servername, $username, $password, $dbname);
								// Check connection
								if ($conn->connect_error) {
								    die("Connection failed: " . $conn->connect_error);
								} 

								$id=$row['user_id'];


								$sql = "SELECT * FROM users where id=".$id;
								$ans = $conn->query($sql);
								$userdata=$ans->fetch_assoc();

								if ($ans->num_rows > 0) {
								     
								    
								    }
								 else {
								    echo "Unable Fetch Post Details ! Please Try Again ";
								}

						  ?>

						  <h4>Show Owner Contact Details</h4>

						<div class="toggle toggle-bg">
							<div class="togglet"><i class="toggle-closed icon-ok-circle"></i><i class="toggle-open icon-remove-circle"></i>Click Here To Reveal</div>
							<div class="togglec">
								<div class="col-md-1"></div>

						<div class="col-md-10">

						
						<div class="table-responsive">
							<table class="table table-bordered table-striped">
							  <colgroup>
								<col class="col-xs-1">
								<col class="col-xs-7">
							  </colgroup>
					
								 <tr>
							  <td>Owner Name</td>
							  <td><?php  if($userdata['name']==""){echo "N.A.";} else {echo $userdata['name'];};?></td>
							  </tr>

							  <tr>
							  <td>Email Id </td>
							  <td><?php  if($userdata['email']==""){echo "N.A.";} else {echo $userdata['email'];};?></td>
							  </tr>

							  <tr>
							  <td>Mobile Number</td>
							  <td><?php  if($userdata['mobile']==""){echo "N.A.";} else {echo $userdata['mobile'];};?></td>
							  </tr>
							  </tbody>
							  </table>
							</div>
						</div>

						  </div>

		</section>

		<script>
			var slideIndex = 1;
			showDivs(slideIndex);

			function plusDivs(n) {
			  showDivs(slideIndex += n);
			}

			function showDivs(n) {
			  var i;
			  var x = document.getElementsByClassName("mySlides");
			  if (n > x.length) {slideIndex = 1}    
			  if (n < 1) {slideIndex = x.length}
			  for (i = 0; i < x.length; i++) {
			     x[i].style.display = "none";  
			  }
			  x[slideIndex-1].style.display = "block";  
			}
		</script>





		<!-- Content
		============================================= -->
		<!-- #content end -->

		<!-- Footer
		============================================= -->
		<?php require_once('footer.php') ?>