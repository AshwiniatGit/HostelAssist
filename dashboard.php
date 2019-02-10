<?php require_once('header.php'); ?><!-- #header end -->

<?php
require 'databaseconfig.php';

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT name FROM users where id=".$_SESSION['id'];
	$result = $conn->query($sql);
	$row=$result->fetch_assoc();
	

	if ($result->num_rows > 0) {
	    
	     
	    }
	 else {
	    echo "Unable Fetch Post Details ! Please Try Again ";
	}

	?>
		<!-- Content
		============================================= -->

		<section id="page-title">

			<div class="container clearfix">
				<h1>DASHBOARD- Welcome <?php echo $row['name']; ?></h1>
				<span>Manage your profile</span>
				<ol class="breadcrumb">
					<li><a href="index.php">Home</a></li>
					<li class="active">Dashboard</li>
				</ol>
			</div>

		</section><!-- #page-title end -->

		<!-- Content
		============================================= -->
		<section id="content">

			<div class="content-wrap">

				<div class="container clearfix">

				
                    <div id="middle" >
					<ul class="clients-grid nobottommargin clearfix">
                   
                        <li> 
						<div class="icon-middle"><a href="add-your-property.php" ><img src="images/clients/add.png" alt="Add New" height="105px" width="150px"></a></div></li>
						<li>
                        <div class="icon-middle"><a href="editpost.php" ><img  src="images/clients/edit2.png" alt="Edit" height="105px" width="150px" ></a></div></li>
						<li><div class="icon-middle"><a href="showpost.php" ><img src="images/clients/view.png" alt="View" height="105px" width="150px" ></a></div></li>
						<li><div class="icon-middle"><a href="update-user-profile.php" ><img src="images/clients/update.png" alt="Update Profile" height="105px" width="150px" ></a></div></li>
						<li><div class="icon-middle"><a href="delete-post.php" ><img src="images/clients/delete.png" alt="Delete"  height="105px" width="150px"></a></div></li>
						
						<?php
						 	if(isset($_SESSION['process'])){
						    if ($_SESSION['process']=="posted"){
						        require 'propertymessage.html';
						        $_SESSION['process']="";
						    } 

						    else if($_SESSION['process']=="updated"){
						    	require 'profileupdatedmessage.html';
						    	$_SESSION['process']="";
						    }
						    else {
						        
						}}
						?>

						</div>
                    </div>
				

		</section>


		<!-- #content end -->

		<!-- Footer
		============================================= -->
		<?php require_once('footer.php'); ?>