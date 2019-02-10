<?php session_start(); ?>

<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>  
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
	<link rel="stylesheet" href="css/responsive.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- Document Title
	============================================= -->
	<title>HostelAssist - Find Your Home Like Stay ! </title>

</head>

<body class="stretched">

<!--google tracking code--> 

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
							<li ><a href="about-us.php"><div>About Us</div></a>
								
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
