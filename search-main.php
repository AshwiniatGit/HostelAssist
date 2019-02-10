<?php require_once('header.php'); ?>

<!-- #header end -->


		<!-- Content

		============================================= -->

<?php

$row = null;

function sanitize_input($data) {
							  $data = trim($data);
							  $data = stripslashes($data);
							  $data = htmlspecialchars($data);
							  return $data;
							}


$_SESSION['city']=sanitize_input($_GET['city']);

$cty= $_SESSION['city'];

if($cty==""){header('location:index.php');}

//code for filter

if (isset($_POST['applyfilter'])){
			
		
	$tblname="houses";

	function PDOFilter($data, $tableName) {

	    
	   $query = "select price,post_id,image1,image2 from {$tableName} where ";

		
		$columnString = "";

		foreach ($data as $key => $value) {
			if($key=="applyfilter"){

			}

			else if($key=="size"){

			}

			else if($key =="flat"){

			}

			else if($key =="pg"){

			}

			else if($key =="independent"){

			}

			else if($key=="non"){

			}

			else if($key=="semi"){

			}

			else if($key=="fully"){

			}

			else if($key=="price")
			{
				if($value==""){

				}
				
				else{
					$columnString.="price <= ".$value." && ";
				}
			}

			else if($key=="bedroom")
			{
				if($value==""){

				}
				else{

					$columnString.="bedroom = ".sanitize_input($value)." && ";
				}
			}

			else
				{
					
					if(substr($columnString, -2) == "| " ){

						$columnString = rtrim($columnString," ");
						$columnString = rtrim($columnString, "|"); 
					}				
				$columnString .= $key."=";
				if($value=="on")
				$columnString .= "'1'"." && ";
				else
				$columnString .= "'{$value}'"." && ";	
				}

		}

		
		

		if(isset($_POST['flat'])=='1' && isset($_POST['pg'])=="" && isset($_POST['independent'])=="")
		{
				$columnString.="  type ='0' && ";
		}

		else if(isset($_POST['flat'])=="" && isset($_POST['pg'])=='1' && isset($_POST['independent'])==""){
				$columnString.="  type ='1' && ";
		}
		
		else if(isset($_POST['flat'])=="" && isset($_POST['pg'])=="" && isset($_POST['independent'])=='1'){
				$columnString.="  type ='2' && ";
		}

		else if(isset($_POST['flat'])=='1' && isset($_POST['pg'])=="1" && isset($_POST['independent'])==''){
				$columnString.="  (type ='0' || type='1') && ";
		}

		else if(isset($_POST['flat'])=="" && isset($_POST['pg'])=="1" && isset($_POST['independent'])=='1'){
				$columnString.=" (type = 1 || type = 2 ) && ";
		}

		else if(isset($_POST['flat'])=="1" && isset($_POST['pg'])=="" && isset($_POST['independent'])=='1'){
				$columnString.="  (type ='0' || type='2' )&& ";
		}

		else if(isset($_POST['flat'])=="1" && isset($_POST['pg'])=="1" && isset($_POST['independent'])=='1'){
				$columnString.="  (type ='0' || type='1' || type='2')&& ";
		}

		if(isset($_POST['non'])=="1" && isset($_POST['semi'])=="" && isset($_POST['fully'])==''){
			$columnString.="  furnished ='0' && ";
		}

		else if(isset($_POST['non'])=="" && isset($_POST['semi'])=="1" && isset($_POST['fully'])==''){
			$columnString.="  furnished ='1' && ";
		}

		else if(isset($_POST['non'])=="" && isset($_POST['semi'])=="" && isset($_POST['fully'])=='1'){
			$columnString.="  furnished ='2' && ";
		}

		else if(isset($_POST['non'])=="1" && isset($_POST['semi'])=="1" && isset($_POST['fully'])==''){
			$columnString.="  (furnished ='0' || furnished='1') && ";
		}

		else if(isset($_POST['non'])=="" && isset($_POST['semi'])=="1" && isset($_POST['fully'])=='1'){
			$columnString.="  (furnished ='1' || furnished='2') && ";
		}

		else if(isset($_POST['non'])=="1" && isset($_POST['semi'])=="" && isset($_POST['fully'])=='1'){
			$columnString.="  (furnished ='0' || furnished='2') && ";
		}

		else if(isset($_POST['non'])=="1" && isset($_POST['semi'])=="1" && isset($_POST['fully'])=='1'){
			$columnString.="  (furnished ='0' || furnished='1' || furnished='2') && ";
		}

		$columnString.= " city = "."'".$_SESSION['city']."'";
                $columnString.="&& status ='1'";

		$columnString = rtrim($columnString," ");
		$columnString = rtrim($columnString, "|");
		$columnString = rtrim($columnString, "&");
		
		$query .= $columnString;

		require 'databaseconfig.php';

		try {
		    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    $stmt = $conn->prepare("$query"); 
		    $stmt->execute();

		    // set the resulting array to associative
		    $result = $stmt->setFetchMode(PDO::FETCH_NUM); 
		    $row=$stmt->fetchAll();

		  //  var_dump($row);

		    return $row;
			}

		catch(PDOException $e) {
		    echo "Error: " . $e->getMessage();
		}


		if ($result->num_rows > 0) {
	     	echo "Found Something !!";
	    }
		 else {
		    echo "No Match found !";
		}	
	}

	$row = PDOFilter($_POST,$tblname);
}

else {

	require 'databaseconfig.php';

try {
	$cty=$_GET['city'];
	$query = "SELECT price,post_id,image1,image2, city FROM houses where city='$cty' ";
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

}
?>

        
		<section id="page-title">

			<div class="container clearfix">
				<h1>Properties in "<?php echo $_SESSION['city']; ?>"  </h1>
				<span>Find Your Home Like Stay </span>
				<ol class="breadcrumb">
					<li><a href="index.php">Home</a></li>
					<li class="active">Search</li>
				</ol>
			</div>

		</section>

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

									<a href="showpostdetail.php?postid=<?php echo $key[1]?>"><img src='images/<?php if($key[2]==""){ echo "imagenotavailable.jpg"; } else {echo "$key[2]";} ?> ' alt="" style="height: 232px; width: 411px;"></a>
									<a href="showpostdetail.php?postid=<?php echo $key[1]?>"><img src='images/<?php if($key[3]==""){ echo "imagenotavailable.jpg"; } else {echo "$key[3]";} ?> ' alt="" style="height: 232px; width: 411px;"></a>
									
									
									
								</div>
								<div class="product-desc center">
									
									<div class="product-price"><ins><?php echo $key[0]; ?> INR</ins></div>
									
								</div>
							</div>
							<?php  endforeach; ?>

							



							
						</div><!-- #shop end -->

					</div><!-- .postcontent end -->

					<!-- Sidebar
					============================================= -->
					<div class="sidebar nobottommargin">
						<div class="sidebar-widgets-wrap">

							
							<form method="post" action="" id="filter" enctype="multipart/form-data">
							<div class="widget clearfix">

								<h4>Filters</h4>
								<div id="post-list-footer">

								

									
									<div class="spost clearfix">
										<div class="">
											<input name="applyfilter" type="submit" class="form-control" value="Apply Filter" > 
										</div>
										
									</div>

									<div class="spost clearfix">
										<div class="">
											<input type="number" name="price" class="form-control" placeholder="Maximum Rent" <?php if (isset($_POST['price'])) { if($_POST['price']==''){} else { echo "value = "."'".$_POST['price']."'";} } ?>> 
										</div>
										
									</div>

									<div class="spost clearfix">
										<div class="">
											<input type="number" name="bedroom" class="form-control" placeholder="Number Of Bedrooms" <?php if (isset($_POST['bedroom'])) { if($_POST['price']==''){} else { echo "value = "."'".$_POST['bedroom']."'";} } ?>> 
										</div>
										
									</div>

									<div class="spost clearfix">
									<div> Property Type</div>
										<div class="">
											<input id="checkbox-1" class="checkbox-style" name="flat" type="checkbox" <?php if (isset($_POST['flat'])) { echo ' checked'; } ?>>
											<label for="checkbox-1" class="checkbox-style-1-label checkbox-small">Flat</label>

											<input id="checkbox-2" class="checkbox-style" name="pg" type="checkbox" <?php if (isset($_POST['pg'])) { echo ' checked'; } ?>>
											<label for="checkbox-2" class="checkbox-style-2-label checkbox-small">P.G</label>

											<input id="checkbox-3" class="checkbox-style" name="independent" type="checkbox" <?php if (isset($_POST['independent'])) { echo ' checked'; } ?>>
											<label for="checkbox-3" class="checkbox-style-3-label checkbox-small">Independent</label>

											</select>
										</div>
										
									</div>

											

									<div class="spost clearfix">
										<div> Furnished</div>
										<div class="">
											<input id="checkbox-4" class="checkbox-style" name="non" type="checkbox" <?php if (isset($_POST['non'])) { echo ' checked'; } ?>>
											<label for="checkbox-4" class="checkbox-style-4-label checkbox-small">Non-Furnished</label><br>

											<input id="checkbox-5" class="checkbox-style" name="semi" type="checkbox" <?php if (isset($_POST['semi'])) { echo ' checked'; } ?>>
											<label for="checkbox-5" class="checkbox-style-5-label checkbox-small">Semi-Furnished</label><br>

											<input id="checkbox-6" class="checkbox-style" name="fully" type="checkbox" <?php if (isset($_POST['fully'])) { echo ' checked'; } ?>>
											<label for="checkbox-6" class="checkbox-style-6-label checkbox-small">Fully-Furnished</label>

											
									</div>
										
									</div>
									
									<div class="spost clearfix">
									  <div> Facilities </div>
									  <div class="">
											<input id="checkbox-7" class="checkbox-style" name="ac" type="checkbox" <?php if (isset($_POST['ac'])) { echo ' checked'; } ?>>
											<label for="checkbox-7" class="checkbox-style-7-label checkbox-small">AC</label><br>

											<input id="checkbox-16" class="checkbox-style" name="cooler" type="checkbox" <?php if (isset($_POST['cooler'])) { echo ' checked'; } ?>>
											<label for="checkbox-16" class="checkbox-style-16-label checkbox-small" >Cooler</label><br>

											<input id="checkbox-8" class="checkbox-style" name="fridge" type="checkbox" <?php if (isset($_POST['fridge'])) { echo ' checked'; } ?>>
											<label for="checkbox-8" class="checkbox-style-8-label checkbox-small" >Refrigerator</label><br>
											
											<input id="checkbox-9" class="checkbox-style" name="waterpurifier" type="checkbox" <?php if (isset($_POST['waterpurifier'])) { echo ' checked'; } ?>>
											<label for="checkbox-9" class="checkbox-style-9-label checkbox-small" >Water Purifier</label><br>

											<input id="checkbox-10" class="checkbox-style" name="wifi" type="checkbox" <?php if (isset($_POST['wifi'])) { echo ' checked'; } ?>>
											<label for="checkbox-10" class="checkbox-style-10-label checkbox-small">Wi-Fi</label><br>

											<input id="checkbox-11" class="checkbox-style" name="geyser" type="checkbox" <?php if (isset($_POST['geyser'])) { echo ' checked'; } ?>>
											<label for="checkbox-11" class="checkbox-style-11-label checkbox-small">Geyser</label><br>

											<input id="checkbox-12" class="checkbox-style" name="inverter" type="checkbox" <?php if (isset($_POST['inverter'])) { echo ' checked'; } ?>>
											<label for="checkbox-12" class="checkbox-style-12-label checkbox-small">Inverter</label><br>

											<input id="checkbox-13" class="checkbox-style" name="tv" type="checkbox" <?php if (isset($_POST['tv'])) { echo ' checked'; } ?>>
											<label for="checkbox-13" class="checkbox-style-13-label checkbox-small">TV</label><br>

											<input id="checkbox-14" class="checkbox-style" name="parking" type="checkbox" <?php if (isset($_POST['parking'])) { echo ' checked'; } ?>>
											<label for="checkbox-14" class="checkbox-style-14-label checkbox-small">Parking</label><br>

											<input id="checkbox-15" class="checkbox-style" name="security" type="checkbox" <?php if (isset($_POST['security'])) { echo ' checked'; } ?>>
											<label for="checkbox-15" class="checkbox-style-15-label checkbox-small">Security</label>



									  </div>
									  </div>

									  <div class="spost clearfix">
										<div class="">
											<input type="submit" name="applyfilter" class="form-control"  value="Apply Filter"> 
										</div>
										
									</div>


									</div>

								</div>

							</div>

							</form>

							
							</div>

						</div>
					</div><!-- .sidebar end -->

				</div>

			</div>

		</section><!-- #content end -->
		<!-- #content end -->

		<!-- Footer
		============================================= -->
		<?php require_once('footer.php'); ?>