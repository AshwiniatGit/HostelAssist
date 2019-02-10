<?php require_once('header.php'); ?>
<!-- #header end -->


		<!-- Content
		============================================= -->

			<?php
			require 'databaseconfig.php';

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			} 

			$poid=$_POST["postid"];


			$sql = "SELECT * FROM houses where post_id=$poid ";
			$result = $conn->query($sql);
			$row=$result->fetch_assoc();
			if ($result->num_rows > 0) {
			     
			     }			       			    
			 else {
			    echo "No Match found !";
			}


							function sanitize_input($data) {
							  $data = trim($data);
							  $data = stripslashes($data);
							  $data = htmlspecialchars($data);
							  return $data;
							}

							$priceErr=$addressErr=$cityErr=$pincodeErr=$bedroomErr=$kitchenErr=$washroomErr=$otherErr="";

						
							if(isset($_POST['updatepost'])){

							 if (!empty($_POST["city"])) {
							     $city=$_POST['city'];
							    // check if name only contains letters and whitespace
							    if (!preg_match("/^[a-zA-Z ]*$/",$city)) {
							      $cityErr = "Invalid Input"; 
							    }
							  }
							  
							  if (empty($_POST["address"])) {
							    $addressErr = "Required";
							  }

							  if (empty($_POST["city"])) {
							    $cityErr = "Required";
							  }

							  if (empty($_POST["pincode"])) {
							    $pincodeErr = "Required";
							  }

							  
							   if ($_POST["price"]<1) {
							    $priceErr = "Invalid Input";
							  } 
							   // check if e-mail address is well-formed
							  
							   if ($_POST["pincode"]<1 || strlen($_POST['pincode'])!=6 ) {
							    $pincodeErr = "Invalid Input";
							  }

							  if ($_POST["bedroom"]<1) {
							    $bedroomErr = "Invalid Input";
							  }

							  if ($_POST["kitchen"]<1) {
							    $kitchenErr = "Invalid Input";
							  }

							  if ($_POST["washroom"]<1) {
							    $washroomErr = "Invalid Input";
							  }

							  else if($priceErr=="" && $addressErr=="" && $cityErr=="" && $pincodeErr=="" && $bedroomErr=="" && $kitchenErr=="" && $washroomErr==""){
							
								$tblname="houses";

								

								function PDOUpdate($data, $tableName) {

								    $post_id= $_POST['postid'];
								    echo "$post_id";
								   
									$query = "update {$tableName} set ";

									
									$columnString = "";

									foreach ($data as $key => $value) {
										if($key=="upload"){

										}
										else if($key=="postid"){

										}
										else if($key=="updatepost"){

										}
										else if($key=="size"){

										}
										else
										{
										$columnString .= $key."=";
										if($value=="on")
										$columnString .= "'1'".",";
										else{
											$value=sanitize_input($value);
										$columnString .= "'{$value}'".",";	
										}}
									}

									$columnString = rtrim($columnString, ",") ;
									$columnString .=' where post_id=';
									$columnString.="$post_id";	

									$img=1;
									$db= mysqli_connect("localhost","aks13077","aksc2h5oh","hostelassist");
									$_SESSION['process']="updatedpost";
									
									
									 
									$columnString = rtrim($columnString, ",") ;
									$columnString = rtrim($columnString, ",") ;

									$query .= $columnString;
									
									$sql=$query;
									
									mysqli_query($db,$sql);
									header('Location: editpost.php');
									
								}
									
								PDOUpdate($_POST,$tblname); 

							}
						}


			?>



			<section id="content">
			
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"  method="post" enctype="multipart/form-data" >
				<input type="hidden" name="postid" value='<?php echo "$poid" ?>'>
			<div class="content-wrap">

				<div class="container clearfix">
                               <div class="col-md-2"><h4>Edit Property</h4><a href="editpost.php">Back To Edit </a></div>
                               <div class="col-md-10">
				<div class="col_one_fourth">
						<h4>Type</h4>
						
					</div>
				<div class="col_one_third">
						<select name="type" class="form-control">

							
							<option value="0" <?php $val=$row['type'];  if ($val=='0') { echo ' selected='.'""'; } ?> >Flat</option>
							<option value="1" <?php $val=$row['type'];  if ($val=='1') { echo ' selected='.'""'; } ?> >PG</option>
							<option value="2" <?php $val=$row['type'];  if ($val=='2') { echo ' selected='.'""'; } ?> >Independent</option>
						</select>
						
					</div>

					<div class="clear"></div>


				<div class="col_one_fourth">
						<h4>Price:<?php echo '<font color="red">'.$priceErr.'</font>' ; ?></h4>
						
					</div>
				<div class="col_one_third">
						<input type="number" name="price" class="form-control" value="<?php echo "$row[price]"; ?>" >
						
					</div>

					<div class="clear"></div>
				<div class="col_one_fourth">
						<h4>Available From</h4>
				</div>
				<div class="col_one_third">
						<select name="availablemonth" class="form-control">
							<option value="0" <?php $val=$row['availablemonth'];  if ($val=='0') { echo ' selected='.'""'; } ?> >Jan</option>
							<option value="1" <?php $val=$row['availablemonth'];  if ($val=='1') { echo ' selected='.'""'; } ?> >Feb</option>
							<option value="2" <?php $val=$row['availablemonth'];  if ($val=='2') { echo ' selected='.'""'; } ?> >Mar</option>
							<option value="3" <?php $val=$row['availablemonth'];  if ($val=='3') { echo ' selected='.'""'; } ?> >Apr</option>
							<option value="4" <?php $val=$row['availablemonth'];  if ($val=='4') { echo ' selected='.'""'; } ?> >May</option>
							<option value="5" <?php $val=$row['availablemonth'];  if ($val=='5') { echo ' selected='.'""'; } ?> >Jun</option>
							<option value="6" <?php $val=$row['availablemonth'];  if ($val=='6') { echo ' selected='.'""'; } ?> >Jul</option>
							<option value="7" <?php $val=$row['availablemonth'];  if ($val=='7') { echo ' selected='.'""'; } ?> >Aug</option>
							<option value="8" <?php $val=$row['availablemonth'];  if ($val=='8') { echo ' selected='.'""'; } ?> >Sep</option>
							<option value="9" <?php $val=$row['availablemonth'];  if ($val=='9') { echo ' selected='.'""'; } ?> >Oct</option>
							<option value="10" <?php $val=$row['availablemonth'];  if ($val=='10') { echo ' selected='.'""'; } ?> >Nov</option>
							<option value="11" <?php $val=$row['availablemonth'];  if ($val=='11') { echo ' selected='.'""'; } ?> >Dec</option>
						</select>
						
					</div>

					<div class="clear"></div>

					<div class="col_one_fourth">
						<h4>Address:<?php echo '<font color="red">'.$addressErr.'</font>' ; ?></h4>
						
					</div>
				<div class="col_one_third">
						<textarea rows="3" cols="26" name="address" class="form-control" value="" ><?php echo "$row[address]"; ?></textarea>
						
					</div>

					<div class="clear"></div>

					<div class="col_one_fourth">
						<h4>City:<?php echo '<font color="red">'.$cityErr.'</font>' ; ?></h4>
						
					</div>
				<div class="col_one_third">
						<input type="text" name="city" required="" class="form-control" value="<?php echo "$row[city]"; ?>"  >
						
					</div>

					<div class="clear"></div>

					<div class="col_one_fourth">
						<h4>Pincode:<?php echo '<font color="red">'.$pincodeErr.'</font>' ; ?></h4>
						
					</div>
				<div class="col_one_third">
						<input type="number" name="pincode" class="form-control" value="<?php echo "$row[pincode]"; ?>" >
						
					</div>

					<div class="clear"></div>

					<div class="col_one_fourth">
						<h4>Furnished</h4>
						
					</div>
				<div class="col_one_third">
						<select name="furnished" class="form-control">
							
							<option value="0"  <?php $val=$row['furnished'];  if ($val=='0') { echo ' selected='.'""'; } ?> >Non Furnished</option>
							<option value="1"  <?php $val=$row['furnished'];  if ($val=='1') { echo ' selected='.'""'; } ?> >Semi Furnished</option>
							<option value="2"  <?php $val=$row['furnished'];  if ($val=='2') { echo ' selected='.'""'; } ?> >Fully Furnished</option>
							
						</select>
						
					</div>

					<div class="clear"></div>

					<div class="col_one_fourth">
						<h4>Bedroom(s):<?php echo '<font color="red">'.$bedroomErr.'</font>' ; ?></h4>
						
					</div>
				<div class="col_one_third">
						<input type="number" name="bedroom" class="form-control" value="<?php echo "$row[bedroom]"; ?>" >
						
					</div>

					<div class="clear"></div>

					<div class="col_one_fourth">
						<h4>Kitchen(s):<?php echo '<font color="red">'.$kitchenErr.'</font>' ; ?></h4>
						
					</div>
				<div class="col_one_third">
						<input type="number" name="kitchen" class="form-control" value="<?php echo "$row[kitchen]"; ?>" >
						
					</div>

					<div class="clear"></div>

					<div class="col_one_fourth">
						<h4>Washroom(s):<?php echo '<font color="red">'.$washroomErr.'</font>' ; ?></h4>
						
					</div>
				<div class="col_one_third">
						<input type="number" name="washroom" class="form-control" value="<?php echo "$row[washroom]"; ?>" >
						
					</div>

					<div class="clear"></div>

					<div class="col_one_fourth">
						<h4>Facilities</h4>
						
					</div>
				<div class="col_two_third">

							<input id="checkbox-1" class="checkbox-style" name="ac" type="checkbox" <?php $val=$row['ac'];  if ($val=='1') { echo ' checked='.'""'; } ?> >
							<label for="checkbox-1" class="checkbox-style-1-label checkbox-small">AC</label>

							<input id="checkbox-10" class="checkbox-style" name="cooler" type="checkbox" <?php $val=$row['cooler'];  if ($val=='1') { echo ' checked='.'""'; } ?> >
							<label for="checkbox-10" class="checkbox-style-9-label checkbox-small">Cooler</label>

							<input id="checkbox-5" class="checkbox-style" name="fridge" type="checkbox" <?php $val=$row['fridge'];  if ($val=='1') { echo ' checked='.'""'; } ?> >
							<label for="checkbox-5" class="checkbox-style-5	-label checkbox-small">Refrigerator</label>
							
							<input id="checkbox-4" class="checkbox-style" name="waterpurifier" type="checkbox" <?php $val=$row['waterpurifier'];  if ($val=='1') { echo ' checked='.'""'; } ?>>
							<label for="checkbox-4" class="checkbox-style-4-label checkbox-small">Water Purifier</label>

							<input id="checkbox-2" class="checkbox-style" name="wifi" type="checkbox" <?php $val=$row['wifi'];  if ($val=='1') { echo ' checked='.'""'; } ?> >
							<label for="checkbox-2" class="checkbox-style-2-label checkbox-small">Wi-Fi</label>

							<input id="checkbox-3" class="checkbox-style" name="geyser" type="checkbox" <?php $val=$row['geyser'];  if ($val=='1') { echo ' checked='.'""'; } ?> >
							<label for="checkbox-3" class="checkbox-style-3-label checkbox-small">Geyser</label>

							<input id="checkbox-6" class="checkbox-style" name="inverter" type="checkbox" <?php $val=$row['inverter'];  if ($val=='1') { echo ' checked='.'""'; } ?> >
							<label for="checkbox-6" class="checkbox-style-6-label checkbox-small">Inverter</label>

							<input id="checkbox-7" class="checkbox-style" name="tv" type="checkbox" <?php $val=$row['tv'];  if ($val=='1') { echo ' checked='.'""'; } ?> >
							<label for="checkbox-7" class="checkbox-style-7-label checkbox-small">TV</label>

							<input id="checkbox-8" class="checkbox-style" name="parking" type="checkbox" <?php $val=$row['parking'];  if ($val=='1') { echo ' checked='.'""'; } ?> >
							<label for="checkbox-8" class="checkbox-style-8-label checkbox-small">Parking</label>

							<input id="checkbox-9" class="checkbox-style" name="security" type="checkbox" <?php $val=$row['security'];  if ($val=='1') { echo ' checked='.'""'; } ?> >
							<label for="checkbox-9" class="checkbox-style-9-label checkbox-small">Security</label>
							
					</div>

					<div class="clear"></div>

					<div class="col_one_fourth">
						<h4>Additional Information</h4>
						
					</div>
				<div class="col_one_third">
						<input type="text" name="other" class="form-control" value="<?php echo "$row[other]"; ?>">
						
					</div>

					<div class="clear"></div>

					<div class="col_one_fourth">
						<h4>Upload Images</h4>
						
					</div>
				<div class="col_two_third">
						<input type="hidden" name="size" value="1000000">

						<input id="input-8" name="image1" value="image1" type="file" accept="image/*" class="form-control" data-allowed-file-extensions='["jpg","jpeg"]'>
						<input id="input-8" name="image2" value="image2" type="file" accept="image/*" class="form-control" data-allowed-file-extensions='["jpg","jpeg"]'>
						<input id="input-8" name="image3" value="image3" type="file" accept="image/*" class="form-control" data-allowed-file-extensions='["jpg","jpeg"]'>
						<input id="input-8" name="image4" value="image4" type="file" accept="image/*" class="form-control" data-allowed-file-extensions='["jpg","jpeg"]'>
						
					</div>

					<div class="clear"></div>

					<div class="col_one_fourth">
						<h4></h4>
						
					</div>
				<div class="col_one_third">
						<input id="checkbox-10" class="checkbox-style" name="showaddress" type="checkbox" <?php $val=$row['showaddress'];  if ($val=='1') { echo ' checked='.'""'; } ?> >
						<label for="checkbox-10" class="checkbox-style-10-label">Show My Address in my post</label>
					</div>

					<div class="clear"></div>

					<div class="col_one_fourth">
						<button type="reset" class="button button-3d but
						ton-rounded button-red"><i class="icon-repeat"></i>Cancel</button>
						
					</div>
				<div class="col_one_fourth">
				<button type="submit" class="button button-3d but
						ton-rounded button-green" name="updatepost"><i class="icon-ok"></i>Update This Post</button>
					
						
					</div>
                                        </div></div>

					<div class="clear"></div>

				

		</section>
		<!-- #content end -->

		<!-- Footer
		============================================= -->
		<?php require_once('footer.php'); ?>