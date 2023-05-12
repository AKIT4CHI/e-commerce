<?php include('partials/menu.php');  ?>

	<!-- Main Section Starts -->
	<div class="main-content">
		<div class="wrapper">
			<h1>Messages</h1>
			<br><br>

			<?php 

				$user_id = $_SESSION['user_id'];

				if (isset($_SESSION['add'])) {
					echo $_SESSION['add'];//Displaying Session Message
					unset($_SESSION['add']);//Removing Session Message
				}

				if (isset($_SESSION['delete'])) {
					echo $_SESSION['delete'];
					unset($_SESSION['delete']);
				}

				if (isset($_SESSION['update'])) {
					echo $_SESSION['update'];
					unset($_SESSION['update']);
					 
				}
				if (isset($_SESSION['user-not-found'])) {
					echo $_SESSION['user-not-found'];
					unset($_SESSION['user-not-found']);
					
				}
				if (isset($_SESSION['pad-not-match'])) {
					echo $_SESSION['pad-not-match'];
					unset($_SESSION['pad-not-match']);
					
				}

				if (isset($_SESSION['change-pad'])) {
					echo $_SESSION['change-pad'];
					unset($_SESSION['change-pad']);
					
				}
				if (isset($_SESSION['user-update-exist'])) {
					echo $_SESSION['user-update-exist'];
					unset($_SESSION['user-update-exist']);
					
				}
			?>
			

			<!-- Button to add Admin -->
			
			<br><br><br><br><br>
			

			<table class="tbl-full">
				<tr>
					
					<th>#</th>
					<th>Message</th>
					
					<th>Actions</th>
				</tr>

				<?php 
					//Query to Get all admin
					$sql = "SELECT tbl_user.id as 'user_id', tbl_message.Message, tbl_message.checked, tbl_message.id FROM tbl_user INNER JOIN tbl_message ON tbl_user.id = tbl_message.user_id where tbl_user.id = $user_id ORDER by tbl_message.Date DESC";
					//Execute the Query
					$res = mysqli_query($conn, $sql);

					//check whether the Query is executed or not

					if ($res==TRUE) {
						// Count Rows To Check whether we have data in database or not
						$count = mysqli_num_rows($res);

						$sn=0;//Create variable And Assign the value

						if ($count>0) {
							// We have data is database
							while ($rows=mysqli_fetch_assoc($res)) {
								//Using while loop to get all data from database
								//And while loop will run as long as we have data in database
								//Get individal Data
								$id=$rows['id'];
								$Message=$rows['Message'];
								$check=$rows['checked'];
								
								$sn++;


								//display the values in ouor table
								?>

								<tr>
									
									<td ><?php echo $sn; ?></td>
									<td <?php if ($check=='No') {
										?>
										class="font-weight"
										<?php 
									} ?> ><?php echo $Message; ?></td>
									
									<td >
										<?php if ($check=='No') {
											?>
											<a href="<?php echo SITEURL ?>admin/check_message.php?Message_id=<?php echo $id; ?>" class="btn-danger" title="Mark As Read"><i class="fa fa-check" aria-hidden="true"></i></a>
											<?php
										} ?>
										
										
									</td>
								</tr>

								<?php

							}
						}
						else{
							
							echo "<div class = 'error'>No Message available</div>";
						}
					}
				?>

				
			</table>
			
			

		</div>
	</div>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<!-- Main Section Ends -->

<?php include('partials/footer.php'); ?>