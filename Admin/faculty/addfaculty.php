<?php

	$Faculty_ID = "";
	$fname = "";
	$lname = "";
	$department = "";
	$phonenumber = "";
	$email = "";

	$em_fid = $em_fname = $em_lname = "";
	$em_dept = $em_phone = $em_email = "";

	$f = 0;

	
	if(isset($_POST['submit'])){

		if(empty($_POST['fid'])){
			$em_fid = 'Enter Faculty_ID';
			$f = 0;
		} else{
			$Faculty_ID = $_POST['fid'];
			$f = 1;
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

		if(empty($_POST['dept'])){
			$em_dept = 'Enter Department';
			$f = 0;
		} else {
			$department = $_POST['dept'];
			$f = 1;
		}

		if(empty($_POST['pnum'])){
			$em_phone = 'Enter Phone Number';
			$f = 0;
		} else {
			$phonenumber = $_POST['pnum'];
			if(!(preg_match('/[0-9]+$/', $phonenumber)) || strlen($phonenumber)>10){
				$em_lname = 'Phone Number must be digits only';
				$f = 0;
			} else {
				$f = 1;
			}
		}

		if($f == 1){
			
			$conn = mysqli_connect("localhost", "root", "","dbmsproject");
	
			$result = mysqli_query($conn, "insert into faculty values ('$Faculty_ID','$email',
					'$fname','$lname','$phonenumber','$department')");
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

	<h4 class="center grey-text">Enter Faculty Details</h4>
	<section class="container grey-text">
		<form class="white" action="addfaculty.php" method="POST">

			<label style="font-weight: bold;" class="ftext">Faculty_ID:</label>
			<input type="text" name="fid" value="<?php echo $Faculty_ID?>">
			<div class="right" id="errormessage">
				<?php
					echo $em_fid;
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

			<label style="font-weight: bold;" class="ftext">Department:</label>
			<input type="text" name="dept" value="<?php echo $department ?>">
			<div class="right" id="errormessage">
				<?php
					echo $em_dept;
				?>
			</div>

			<label style="font-weight: bold;" class="ftext">Phone Number:</label>
			<input type="text" name="pnum" value="<?php echo $phonenumber ?>">
			<div class="right" id="errormessage">
				<?php
					echo $em_phone;
				?>
			</div>

			<div class="center">
				<span class="ftext1">
					<input type="submit" name="submit" value="CONFIRM & ADD FACULTY" class="btn brand z-depth-0">
				</span>
			</div>

		</form>
	</section>
	
	<?php include('../../templates/footer.php') ?>

</html>