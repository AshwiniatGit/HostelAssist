<?php require_once('header.php'); ?>

<!-- #header end -->
<?php
function sanitize_input($data) {
							  $data = trim($data);
							  $data = stripslashes($data);
							  $data = htmlspecialchars($data);
							  return $data;
							}

							$priceErr=$addressErr=$cityErr=$pincodeErr=$bedroomErr=$kitchenErr=$washroomErr=$otherErr="";

						
							if(isset($_POST['submit'])){

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
							  
							   if  (strlen($_POST['pincode'])!=6 ) {
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

								function PDOInsert($data, $tableName) {

								   
									$query = "INSERT INTO {$tableName} ";

									$columnString = "(";

									$columnValueString = "VALUES (";

									foreach ($data as $key => $value) {
										if($key=="submit"){

										}
										else if($key=="size"){

										}
										else
										{
										$columnString .= $key.",";
										if($value=="on")
										$columnValueString .= "'1'".",";
										else{
											$value=sanitize_input($value);
										$columnValueString .= "'{$value}'".",";	
										}}
									}
									$columnString .='user_id'.",";
									$columnValueString.="'".$_SESSION['id']."'".",";	

									$img=1;
									$db= mysqli_connect("localhost","aks13077","aksc2h5oh","hostelassist");
									
                                                                        
									$_SESSION['process']="posted";

									for($i=0;$i<4;$i++)
									{
									

									$target= "images/".basename($_FILES['image'.$img]['name']);
									
									

									$image=$_FILES['image'.$img]['name'];

									$columnString .= 'image'.$img.",";
									$columnValueString .= "'{$image}'".",";	


										if(move_uploaded_file($_FILES['image'.$img]['tmp_name'], $target)){
										$msg="Image upload !!!";
										

									} 
									else
									{
										$msg="Problem !!!";
										echo "Problem";
									}

									$img++;
									
									}
									$columnString = rtrim($columnString, ",") . ")";
									$columnValueString = rtrim($columnValueString, ",") . ")";

									$query .= $columnString." ".$columnValueString;
									$sql=$query;
								
									mysqli_query($db,$sql);
									
									header('Location: dashboard.php');
								}

									PDOInsert($_POST,$tblname); 
							  }

							  }

 ?>


		<!-- Content
		============================================= -->
		<section id="content">
			
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"  method="post" enctype="multipart/form-data" >

			<div class="content-wrap">

				<div class="container clearfix">
					<div class="col_one_fourth"><h4>Post New Property</h4><br><a href="dashboard.php">Back to dashboard</a></div>
					<div class="col_three_fourth col_last">
					<div class="col_one_fourth">
						<h4>Type:</h4>
						
					</div>
				<div class="col_one_third">
						<select name="type" class="form-control">

							
							<option value="0" <?php if (isset($_POST['type']) && $_POST['type']==0) { echo ' selected='.'""'; } ?>>Flat</option>
							<option value="1" <?php if (isset($_POST['type']) && $_POST['type']==1) { echo ' selected='.'""'; } ?> >PG</option>
							<option value="2" <?php if (isset($_POST['type']) && $_POST['type']==2) { echo ' selected='.'""'; } ?>>Independent</option>
						</select>
						
					</div>

					<div class="clear"></div>


				<div class="col_one_fourth">
						<h4>Price:<?php echo '<font color="red">'.$priceErr.'</font>' ; ?></h4>
						
					</div>
				<div class="col_one_third">
						<input type="number" name="price" class="form-control" value="<?php if(isset($_POST['price'])){echo $_POST['price'];}?>">
						
					</div>

					<div class="clear"></div>
				<div class="col_one_fourth">
						<h4>Available From:</h4>
				</div>
				<div class="col_one_third">
						<select name="availablemonth" class="form-control">
							<option value="0" <?php if(isset($_POST['availablemonth']) && $_POST['availablemonth']==0) { echo ' selected='.'""'; } ?>>Jan</option>
							<option value="1" <?php if(isset($_POST['availablemonth']) && $_POST['availablemonth']==1) { echo ' selected='.'""'; } ?>>Feb</option>
							<option value="2" <?php if(isset($_POST['availablemonth']) && $_POST['availablemonth']==2) { echo ' selected='.'""'; } ?>>Mar</option>
							<option value="3" <?php if(isset($_POST['availablemonth']) && $_POST['availablemonth']==3) { echo ' selected='.'""'; } ?>>Apr</option>
							<option value="4" <?php if(isset($_POST['availablemonth']) && $_POST['availablemonth']==4) { echo ' selected='.'""'; } ?>>May</option>
							<option value="5" <?php if(isset($_POST['availablemonth']) && $_POST['availablemonth']==5) { echo ' selected='.'""'; } ?>>Jun</option>
							<option value="6" <?php if(isset($_POST['availablemonth']) && $_POST['availablemonth']==6) { echo ' selected='.'""'; } ?>>Jul</option>
							<option value="7" <?php if(isset($_POST['availablemonth']) && $_POST['availablemonth']==7) { echo ' selected='.'""'; } ?>>Aug</option>
							<option value="8" <?php if(isset($_POST['availablemonth']) && $_POST['availablemonth']==8) { echo ' selected='.'""'; } ?>>Sep</option>
							<option value="9" <?php if(isset($_POST['availablemonth']) && $_POST['availablemonth']==9) { echo ' selected='.'""'; } ?>>Oct</option>
							<option value="10" <?php if(isset($_POST['availablemonth']) && $_POST['availablemonth']==10) { echo ' selected='.'""'; } ?>>Nov</option>
							<option value="11" <?php if(isset($_POST['availablemonth']) && $_POST['availablemonth']==11) { echo ' selected='.'""'; } ?>>Dec</option>
						</select>
						
					</div>

					<div class="clear"></div>

					<div class="col_one_fourth">
						<h4>Address:<?php echo '<font color="red">'.$addressErr.'</font>' ; ?></h4>
						
					</div>
				<div class="col_one_third">
						<textarea rows="3" cols="26" name="address" class="form-control" ><?php if(isset($_POST['address'])){echo $_POST['address'];}?></textarea>
						
					</div>

					<div class="clear"></div>

					<div class="col_one_fourth">
						<h4>City:<?php echo '<font color="red">'.$cityErr.'</font>' ; ?></h4>
						
					</div>
				<div class="col_one_third">
						<input type="text" name="city" class="form-control" value="<?php if(isset($_POST['city'])){echo $_POST['city'];}?>">
						
					</div>

					<div class="clear"></div>

					<div class="col_one_fourth">
						<h4>Pincode:<?php echo '<font color="red">'.$pincodeErr.'</font>' ; ?></h4>
						
					</div>
				<div class="col_one_third">
						<input type="number" name="pincode" class="form-control" value="<?php if(isset($_POST['pincode'])){echo $_POST['pincode'];}?>">
						
					</div>

					<div class="clear"></div>

					<div class="col_one_fourth">
						<h4>Furnished:</h4>
						
					</div>
				<div class="col_one_third">
						<select name="furnished" class="form-control">
							
							<option value="0">Non Furnished</option>
							<option value="1">Semi Furnished</option>
							<option value="2">Fully Furnished</option>
							
						</select>
						
					</div>

					<div class="clear"></div>

					<div class="col_one_fourth">
						<h4>Bedroom(s):<?php echo '<font color="red">'.$bedroomErr.'</font>' ; ?></h4>
						
					</div>
				<div class="col_one_third">
						<input type="number" name="bedroom" class="form-control" value="<?php if(isset($_POST['bedroom'])){echo $_POST['bedroom'];}?>">
						
					</div>

					<div class="clear"></div>

					<div class="col_one_fourth">
						<h4>Kitchen(s):<?php echo '<font color="red">'.$kitchenErr.'</font>' ; ?></h4>
						
					</div>
				<div class="col_one_third">
						<input type="number" name="kitchen" class="form-control" value="<?php if(isset($_POST['kitchen'])){echo $_POST['kitchen'];}?>">
						
					</div>

					<div class="clear"></div>

					<div class="col_one_fourth">
						<h4>Washroom(s):<?php echo '<font color="red">'.$washroomErr.'</font>' ; ?></h4>
						
					</div>
				<div class="col_one_third">
						<input type="number" name="washroom" class="form-control" value="<?php if(isset($_POST['washroom'])){echo $_POST['washroom'];}?>">
						
					</div>

					<div class="clear"></div>

					<div class="col_one_fourth">
						<h4>Facilities</h4>
						
					</div>
				<div class="col_two_third">

							<input id="checkbox-1" class="checkbox-style" name="ac" type="checkbox" <?php if (isset($_POST['ac'])) { echo ' checked='.'""'; } ?>>
							<label for="checkbox-1" class="checkbox-style-1-label checkbox-small">AC</label>

							<input id="checkbox-10" class="checkbox-style" name="cooler" type="checkbox" <?php if (isset($_POST['cooler'])) { echo ' checked='.'""'; } ?>>
							<label for="checkbox-10" class="checkbox-style-8-label checkbox-small" >Cooler</label>

							<input id="checkbox-5" class="checkbox-style" name="fridge" type="checkbox" <?php if (isset($_POST['fridge'])) { echo ' checked='.'""'; } ?>>
							<label for="checkbox-5" class="checkbox-style-5	-label checkbox-small">Refrigerator</label>
							
							<input id="checkbox-4" class="checkbox-style" name="waterpurifier" type="checkbox" <?php if (isset($_POST['waterpurifier'])) { echo ' checked='.'""'; } ?>>
							<label for="checkbox-4" class="checkbox-style-4-label checkbox-small">Water Purifier</label>

							<input id="checkbox-2" class="checkbox-style" name="wifi" type="checkbox" <?php if (isset($_POST['wifi'])) { echo ' checked='.'""'; } ?>>
							<label for="checkbox-2" class="checkbox-style-2-label checkbox-small">Wi-Fi</label>

							<input id="checkbox-3" class="checkbox-style" name="geyser" type="checkbox" <?php if (isset($_POST['geyser'])) { echo ' checked='.'""'; } ?>>
							<label for="checkbox-3" class="checkbox-style-3-label checkbox-small">Geyser</label>

							<input id="checkbox-6" class="checkbox-style" name="inverter" type="checkbox" <?php if (isset($_POST['inverter'])) { echo ' checked='.'""'; } ?>>
							<label for="checkbox-6" class="checkbox-style-6-label checkbox-small">Inverter</label>

							<input id="checkbox-7" class="checkbox-style" name="tv" type="checkbox" <?php if (isset($_POST['tv'])) { echo ' checked='.'""'; } ?>>
							<label for="checkbox-7" class="checkbox-style-7-label checkbox-small">TV</label>

							<input id="checkbox-8" class="checkbox-style" name="parking" type="checkbox" <?php if (isset($_POST['parking'])) { echo ' checked='.'""'; } ?>>
							<label for="checkbox-8" class="checkbox-style-8-label checkbox-small">Parking</label>

							<input id="checkbox-9" class="checkbox-style" name="security" type="checkbox" <?php if (isset($_POST['security'])) { echo ' checked='.'""'; } ?>>
							<label for="checkbox-9" class="checkbox-style-9-label checkbox-small">Security</label>
							
					</div>

					<div class="clear"></div>

					<div class="col_one_fourth">
						<h4>Additional Information</h4>
						
					</div>
				<div class="col_one_third">
						<input type="text" name="other" class="form-control" value="<?php if(isset($_POST['other'])){echo $_POST['other'];}?>">
						
					</div>

					<div class="clear"></div>

					<div class="col_one_fourth">
						<h4>Upload Images</h4>
						
					</div>
				<div class="col_two_third">
						<input type="hidden" name="size" value="10000000">

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
						<input id="checkbox-10" class="checkbox-style" name="showaddress" type="checkbox" checked>
						<label for="checkbox-10" class="checkbox-style-10-label">Show My Address in my post</label>
					</div>

					<div class="clear"></div>

					<div class="col_one_fourth">
						<button type="reset" class="button button-3d but
						ton-rounded button-red"><i class="icon-repeat"></i>Reset Form</button>
						
					</div>
				<div class="col_one_fourth">
				<button type="submit" class="button button-3d but
						ton-rounded button-green" name="submit"><i class="icon-ok"></i>Post This Property</button>
					
						
					</div>
					</div>
					

					<div class="clear"></div>

				

		</section>
		<!-- #content end -->

		<!-- Footer
		============================================= -->
		<?php require_once('footer.php'); ?>