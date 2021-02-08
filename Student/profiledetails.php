<?php

	session_start();
	$email = $_SESSION['varname'];
	
	$USN = "";
	$name = "";
	$semester = "";
	$dateofbirth = "";
	$phonenumber = "";
	$conn = mysqli_connect("localhost", "root", "","dbmsproject");
	
			//query the database for users
	$result = mysqli_query($conn, "select * from student where Email = '$email'")
				or die("Failed to query database");
	
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$USN = $row['USN'];
		$name = $row['First_name']." ".$row['Last_name'];
		$semester = $row['Semester'];
		$dateofbirth = $row['Date_of_birth'];
		$phonenumber = $row['Phone_number'];
	}
?>

<!DOCTYPE html>
<html>
	
	<?php include('../templates/header1.php') ?>
				<ul id="nav-mobile" class="right hide-on-small-and-down">
					<li id="back"><a href="./mainpage.php" class="btn brand z-depth-0">Back to Home Page</a></li>
				</ul>
			</div>
		</nav>

	<h4 class="center grey-text">Profile Details</h4>
	<section class="container grey-text">
		<form class="white" action="profiledetails.php" method="POST">

			<label style="font-weight: bold;" class="ftext">USN:</label>
			<input type="text" value="<?php echo $USN ?>" readonly>

			<label style="font-weight: bold;" class="ftext">Name:</label>
			<input type="text" value="<?php echo $name ?>" readonly>
			
			<label style="font-weight: bold;" class="ftext">Email:</label>
			<input type="text" value="<?php echo $email ?>" readonly>

			<label style="font-weight: bold;" class="ftext">Semester:</label>
			<input type="text" value="<?php echo $semester ?>" readonly>

			<label style="font-weight: bold;" class="ftext">Date Of Birth:</label>
			<input type="text" value="<?php echo $dateofbirth ?>" readonly>

			<label style="font-weight: bold;" class="ftext">Phone Number:</label>
			<input type="text" value="<?php echo $phonenumber ?>" readonly>

		</form>
	</section>
	
	<?php include('../templates/footer.php') ?>

</html>