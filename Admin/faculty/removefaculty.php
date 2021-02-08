<?php

	$fname = $lname = $department = $email = "";
	$em_email = $em_dept = "";
	$f = 1;

	if(isset($_POST['submit'])){
		if(!empty($_POST['fname'])){
			$fname = $_POST['fname'];
		}
		if(!empty($_POST['lname'])){
			$lname = $_POST['lname'];
		}
		if(empty($_POST['email'])){
			$em_email = 'Email is necessary!'; $f = 0;
		} else {
			$email = $_POST['email'];
			//validating email
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$em_email = "Enter a valid email address!"; $f = 0;
			}
		}
		if(empty($_POST['dept'])){
			$em_dept = 'Department is required!';
			$f = 0;
		} else {
			$department = $_POST['dept'];
		}

		if($f == 1){
			// echo $fname,$lname,$department,$email;
			$conn = mysqli_connect("localhost", "root", "","dbmsproject");
			$result = mysqli_query($conn, "DELETE from faculty WHERE Email = '$email' and Name_of_Dept = '$department'");
			if($result == True){
				//echo $Faculty_ID,$email,$fname,$lname,$department,$phonenumber;
				echo '<script>
					alert("Deletion from table successful");
					window.location.href="../userprofiles.php";
					</script>';
			}
		}
	}

?>
<!DOCTYPE html>
<html>
	
	<?php include('../../templates/header1.php') ?>
				<ul id="nav-mobile" class="right hide-on-small-and-down">
					<li id="back"><a href="../userprofiles.php" class="btn brand z-depth-0">Click to Return</a></li>
				</ul>
			</div>
		</nav>

	<h4 class="center grey-text">Enter Details of Faculty to be Removed</h4>
	<section class="container grey-text">
		<form class="white" action="removefaculty.php" method="POST">

			<label style="font-weight: bold;" class="ftext">First Name:</label>
			<input type="text" name="fname" value="<?php echo $fname ?>">

			<label style="font-weight: bold;" class="ftext">Last Name:</label>
			<input type="text" name="lname" value="<?php echo $lname ?>">
			
			<label style="font-weight: bold;" class="ftext">Email:</label>
			<input type="text" name="email" value="<?php echo $email ?>">
			<div class="right" id="errormessage">
				<?php
					echo $em_email;
				?>
			</div>

			<label style="font-weight: bold;" class="ftext">Department:</label>
			<input type="text" name="dept" value="<?php echo $department ?>">
			<div class="right" id="errormessage">
				<?php
					echo $em_dept;
				?>
			</div>

			<div class="center" style="margin-top: 25px;">
				<span class="ftext1">
					<input type="submit" name="submit" value="CONFIRM & REMOVE FACULTY" class="btn brand z-depth-0">
				</span>
			</div>

		</form>
	</section>
	
	<?php include('../../templates/footer.php') ?>

</html>