<?php

	$USN = "";
	$fname = "";
	$lname = "";
	$dateofbirth = "";
	$semester = "";
	$phonenumber = "";
	$email = "";

	$em_usn = $em_fname = $em_lname = "";
	$em_dob = $em_phone = $em_email = "";
	$em_sem = "";

	$f = 1;

	
	if(isset($_POST['submit'])){

		if(empty($_POST['usn'])){
			$em_usn = 'Enter Student USN';
			$f = 0;
		} else{
			$USN = $_POST['usn'];
		}

		if(empty($_POST['fname'])){
			$em_fname = 'Enter First Name';
			$f = 0;
		} else{
			$fname = $_POST['fname'];
			//validating name
			if(!preg_match('/[a-zA-Z\s]+$/', $fname)){
				$em_fname = 'Name must be letters and spaces only';
				$f = 0;
			}
		}

		if(empty($_POST['lname'])){
			$em_lname = 'Enter Last Name'; $f = 0;
		} else{
			$lname = $_POST['lname'];
			//validating name
			if(!preg_match('/[a-zA-Z\s]+$/', $lname)){
				$em_lname = 'Name must be letters and spaces only';
				$f = 0;
			}
		}

		if(empty($_POST['email'])){
			$em_email = 'Enter Email'; $f = 0;
		} else {
			$email = $_POST['email'];
			//validating email
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$em_email = "Enter a valid email address"; $f = 0;
			}
		}

		if(empty($_POST['dob'])){
			$em_dob = 'Enter Date of Birth';
			$f = 0;
		} else {
			$dateofbirth = $_POST['dob'];
		}

		if(empty($_POST['sem'])){
			$em_sem = 'Enter Semester';
			$f = 0;
		} else {
			$semester = $_POST['sem'];
			if(!($semester>=1 && $semester<=8)){
				$em_sem = 'Enter a valid integer between 1 and 8 for semester';
				$f = 0;
			}
		}

		if(empty($_POST['pnum'])){
			$em_phone = 'Enter Phone Number';
			$f = 0;
		} else {
			$phonenumber = $_POST['pnum'];
			if(!(preg_match('/[0-9]+$/', $phonenumber)) || strlen($phonenumber)>10){
				$em_lname = 'Phone Number must be digits only';
				$f = 0;
			}
		}

		if($f == 1){

			//echo $USN,$fname,$lname,$email,$semester,$dateofbirth,$phonenumber;
			
			$conn = mysqli_connect("localhost", "root", "","dbmsproject");
	
			$result = mysqli_query($conn, "insert into student values ('$USN','$email',
					'$fname','$lname','$dateofbirth','$semester','$phonenumber')");
			if($result == True){
				//echo $Faculty_ID,$email,$fname,$lname,$department,$phonenumber;
				echo '<script>
					alert("Insertion into table successful");
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

	<h4 class="center grey-text">Enter Student Details</h4>
	<section class="container grey-text">
		<form class="white" action="addstudent.php" method="POST">

			<label style="font-weight: bold;" class="ftext">Student USN:</label>
			<input type="text" name="usn" value="<?php echo $USN?>">
			<div class="right" id="errormessage">
				<?php
					echo $em_usn;
				?>
			</div>

			<label style="font-weight: bold;" class="ftext">First Name:</label>
			<input type="text" name="fname" value="<?php echo $fname ?>">
			<div class="right" id="errormessage">
				<?php
					echo $em_fname;
				?>
			</div>

			<label style="font-weight: bold;" class="ftext">Last Name:</label>
			<input type="text" name="lname" value="<?php echo $lname ?>">
			<div class="right" id="errormessage">
				<?php
					echo $em_lname;
				?>
			</div>
			
			<label style="font-weight: bold;" class="ftext">Email:</label>
			<input type="text" name="email" value="<?php echo $email ?>">
			<div class="right" id="errormessage">
				<?php
					echo $em_email;
				?>
			</div>

			<label style="font-weight: bold;" class="ftext">Semester:</label>
			<input type="text" name="sem" value="<?php echo $semester ?>">
			<div class="right" id="errormessage">
				<?php
					echo $em_sem;
				?>
			</div>

			<label style="font-weight: bold;" class="ftext">Date of Birth:</label>
			<input type="date" name="dob" value="<?php echo $dateofbirth?>">
			<div class="right" id="errormessage">
				<?php
					echo $em_dob;
				?>
			</div>


			<label style="font-weight: bold;" class="ftext">Phone Number:</label>
			<input type="text" name="pnum" value="<?php echo $phonenumber ?>">
			<div class="right" id="errormessage">
				<?php
					echo $em_phone;
				?>
			</div>

			<div class="center" style="margin-top: 25px;">
				<span class="ftext1">
					<input type="submit" name="submit" value="CONFIRM & ADD STUDENT" class="btn brand z-depth-0">
				</span>
			</div>

		</form>
	</section>
	
	<?php include('../../templates/footer.php') ?>

</html>